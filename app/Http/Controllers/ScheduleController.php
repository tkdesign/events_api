<?php

namespace App\Http\Controllers;

use App\Models\EventHasUser;
use App\Models\Lecture;
use App\Models\LectureHasUser;
use App\Models\Schedule;
use App\Models\Slot;
use App\Models\Speaker;
use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //

    public function getCurrentEventSchedule(): \Illuminate\Http\JsonResponse
    {
        $is_guest = auth()->guest();

        $stages = Stage::query()
            ->select(['stages.*', 'schedules.schedule_id'])
            ->join('schedules_has_stages', 'schedules_has_stages.stage_id', '=', 'stages.stage_id')
            ->join('schedules', 'schedules.schedule_id', '=', 'schedules_has_stages.schedule_id')
            ->join('events', 'events.event_id', '=', 'schedules.event_id')
            ->where('events.is_current', '=', true)
            ->get();
        $stages_data = [];
        foreach ($stages as $stage) {
            $stage_data = [
                'stage_id' => $stage->stage_id,
                'title' => $stage->title,
                'location' => $stage->location,
                'max_capacity' => $stage->max_capacity,
            ];
            $slots_data = [];
            $slots = Slot::query()
                ->select('slots.*')
                ->where('slots.stage_id', '=', $stage->stage_id)
                ->where('slots.schedule_id', '=', $stage->schedule_id)->get();
            foreach ($slots as $slot) {
                $slot_data = [
                    'slot_id' => $slot->slot_id,
                    'day' => $slot->day->format('Y-m-d'),
                    'start_time' => $slot->start_time->format('H:i:s'),
                    'end_time' => $slot->end_time->format('H:i:s'),
                ];
                $lecture = Lecture::query()
                    ->select('lectures.*')
                    ->join('slots', 'slots.lecture_id', '=', 'lectures.lecture_id')
                    ->where('slots.slot_id', '=', $slot->slot_id)->first();
                if (empty($lecture)) {
                    continue;
                }
                $lecture_data = [
                    'lecture_id' => $lecture->lecture_id,
                    'title' => $lecture->title,
                    'short_desc' => $lecture->short_desc,
                    'desc' => $lecture->desc,
                    'image' => $lecture->image,
                    'capacity' => $lecture->capacity,
                ];

                if (!$is_guest) {
                    $user = auth()->user();
                    $user_data = $lecture->user($user->getAuthIdentifier());
                    $slot_data['user'] = $user_data;
                } else {
                    $slot_data['user'] = null;
                }

                $speaker = Speaker::query()
                    ->select('speakers.*')
                    ->join('lectures_has_speakers', 'lectures_has_speakers.speaker_id', '=', 'speakers.speaker_id')
                    ->where('lectures_has_speakers.lecture_id', '=', $lecture->lecture_id)
                    ->first();
                if (empty($speaker)) {
                    continue;
                }
                $speaker_data = [
                    'speaker_id' => $speaker->speaker_id,
                    'titul' => $speaker->titul,
                    'first_name' => $speaker->first_name,
                    'last_name' => $speaker->last_name,
                    'company' => $speaker->company,
                    'occupation' => $speaker->occupation,
                    'short_desc' => $speaker->short_desc,
                    'desc' => $speaker->desc,
                    'email' => $speaker->email,
                    'phone' => $speaker->phone,
                    'facebook' => $speaker->facebook,
                    'instagram' => $speaker->instagram,
                    'linkedin' => $speaker->linkedin,
                    'image' => $speaker->image,
                    'thumbnail' => $speaker->thumbnail
                ];
                $lecture_data['speaker'] = $speaker_data;
                $slot_data['lecture'] = $lecture_data;
                $slots_data[] = $slot_data;
            }
            $stage_data['slots'] = $slots_data;
            $stages_data[] = $stage_data;
        }

        $subscribed = 0;
        if (!$is_guest) {
            $eventHasUser = EventHasUser::query()
                ->whereHas('event', function ($query) {
                    $query->where('is_current', 1);
                })
                ->where('user_id', auth()->id())
                ->first();
            $subscribed = empty($eventHasUser) ? 0 : 1;
        }

        $schedule_data = [
            'subscribed' => $subscribed,
            'stages' => $stages_data
        ];

        return response()->json($schedule_data);
    }

    public function checkin(Request $request)
    {
        if (!Auth()->check()) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }
        $user = auth()->user();

        $lecture_id = $request->input('lecture_id');
        $lecture = Lecture::query()->find($lecture_id);
        if (empty($lecture)) {
            return response()->json(['success' => false, 'message' => 'Lecture not found']);
        }
        $user_data = User::find($user->getAuthIdentifier());

        if (empty($user_data)) {
            return response()->json(['success' => false, 'message' => 'User is not a participant']);
        }

        $usersCount = $lecture->users()->count();
        if ($usersCount >= $lecture->capacity) {
            return response()->json(['success' => false, 'message' => 'Lecture is full']);
        }

        $slot_id = $request->input('slot_id');
        $selectedSlot = Slot::query()->find($slot_id);
        if (empty($selectedSlot)) {
            return response()->json(['success' => false, 'message' => 'Slot not found']);
        }

        $checkOverlap = $this->checkOverlap($selectedSlot, $user->getAuthIdentifier());

        if ($checkOverlap) {
            return response()->json(['success' => false, 'message' => 'User has already subscribed to another lecture at the same time']);
        }

        $lecture->users()->attach($user->getAuthIdentifier(),
            ['created_at' => now(), 'updated_at' => now()]
        );
        return response()->json(['success' => true]);
    }

    public function checkOverlap($selectedSlot, $userId): bool
    {
        $selectedStartTime = $selectedSlot->start_time;
        $selectedEndTime = $selectedSlot->end_time;

        $overlapSlots = Slot::whereHas('schedule', function ($query) {
                $query->whereHas('event', function ($query) {
                    $query->where('is_current', 1);
                });
            })
            ->whereHas('lecture', function ($query) use ($userId) {
                $query->whereHas('users', function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                });
            })
            ->where('day', $selectedSlot->day)
            ->where('slot_id', '!=', $selectedSlot->slot_id)
            ->where(function ($query) use ($selectedStartTime, $selectedEndTime) {
                $query->whereBetween('start_time', [$selectedStartTime, $selectedEndTime])
                    ->orWhereBetween('end_time', [$selectedStartTime, $selectedEndTime]);
            })
            ->get();
        if ($overlapSlots->count() > 0) {
            return true;
        }
        return false;
    }

    public function checkout(Request $request)
    {
        if (!Auth()->check()) {
            return response()->json(['success' => false, 'message' => 'User not authenticated']);
        }
        $user = auth()->user();

        $lecture_id = $request->input('lecture_id');
        $lecture = Lecture::query()->find($lecture_id);
        if (empty($lecture)) {
            return response()->json(['success' => false, 'message' => 'lecture not found']);
        }
        $user_data = User::find($user->getAuthIdentifier());
        if (empty($user_data)) {
            return response()->json(['success' => false, 'message' => 'User is not a participant']);
        }
        $lecture->users()->detach($user->getAuthIdentifier());
        return response()->json(['success' => true]);
    }

    public function getSchedulesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[title]=asd
        */
        $schedules = Schedule::query()
//            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->whereHas('event', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.title', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'schedule_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($schedules as &$item) {
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
        }
        return response()->json($schedules);
    }

    public function getSchedulesAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $schedules = Schedule::query()
            ->orderBy($request->get('sortBy', 'schedule_id'), $request->get('sortOrder', 'asc'))
            ->get(['schedule_id']);
        return response()->json($schedules);
    }

    public function getScheduleAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
        $schedule->setRelation('event', $schedule->event()->first(['event_id', 'title']));
        return response()->json($schedule);
    }

    public function updateSchedule(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['message' => 'Missing required fields'], 400);
        }
        if ($request->has('schedule_id') && $request->post('schedule_id') > 0) {
            $schedule = Schedule::find($request->post('schedule_id'));
            if (!$schedule) {
                return response()->json(['message' => 'Schedule not found'], 404);
            }
            $schedule->event_id = $request->post('event_id', 0);
            $schedule->save();
            $schedule->setRelation('event', $schedule->event()->first(['event_id', 'title']));
            return response()->json($schedule);
        }
        return response()->json(['message' => 'Schedule not found'], 404);
    }

    public function createSchedule(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['message' => 'Missing required fields'], 400);
        }
        $schedule = new Schedule();
        $schedule->event_id = $request->post('event_id', 0);
        $schedule->save();
        $schedule->setRelation('event', $schedule->event()->first(['event_id', 'title']));
        return response()->json($schedule);
    }

    public function deleteSchedule(int $id): \Illuminate\Http\JsonResponse
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
        $schedule->delete();
        return response()->json(['message' => 'Schedule deleted']);
    }
}
