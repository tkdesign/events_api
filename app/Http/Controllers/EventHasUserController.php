<?php

namespace App\Http\Controllers;

use App\Mail\EventSubscribe;
use App\Mail\EventUnsubscribe;
use App\Models\Event;
use App\Models\EventHasUser;
use App\Models\LectureHasUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EventHasUserController extends Controller
{
    //
    public function getEventsHasUsersAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[event_title]=asd&search[user_name]=asdasd
        */
        $eventsHasUsers = EventHasUser::query()
            ->whereHas('event', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.event_title', '') . '%');
            })
            ->whereHas('user', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('search.user_name', '') . '%')->orWhere('last_name', 'like', '%' . $request->input('search.user_name', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($eventsHasUsers as &$item) {
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
            $item->setRelation('user', $item->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
        }
        return response()->json($eventsHasUsers);
    }

    public function getEventHasUserAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $eventHasUser = EventHasUser::find($id);
        if (!$eventHasUser) {
            return response()->json(['status' => false, 'message' => 'Event/Sponsor Relation not found']);
        }
        $eventHasUser->setRelation('event', $eventHasUser->event()->first(['event_id', 'title']));
        $eventHasUser->setRelation('user', $eventHasUser->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
        return response()->json($eventHasUser);
    }

    public function updateEventHasUser(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id') || !$request->has('user_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $eventHasUser = EventHasUser::find($request->post('id'));
            if (!$eventHasUser) {
                return response()->json(['status' => false, 'message' => 'Event/User Relation not found']);
            }
            $eventHasUser->event_id = (int) $request->post('event_id', 0);
            $eventHasUser->user_id = (int) $request->post('user_id', 0);
            $eventHasUser->visible = (int) $request->post('visible', 1);
            $eventHasUser->position = (int) $request->post('position', 1);
            $eventHasUser->save();
            $eventHasUser->setRelation('event', $eventHasUser->event()->first(['event_id', 'title']));
            $eventHasUser->setRelation('user', $eventHasUser->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
            return response()->json($eventHasUser);
        }
        return response()->json(['status' => false, 'message' => 'Event/User Relation not found']);
    }

    public function createEventHasUser(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $eventHasUser = new EventHasUser();
        $eventHasUser->event_id = (int) $request->post('event_id', 0);
        $eventHasUser->user_id = (int) $request->post('user_id', 0);
        $eventHasUser->visible = (int) $request->post('visible', 1);
        $eventHasUser->position = (int) $request->post('position', 1);
        $eventHasUser->save();
        $eventHasUser->setRelation('event', $eventHasUser->event()->first(['event_id', 'title']));
        $eventHasUser->setRelation('user', $eventHasUser->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
        return response()->json($eventHasUser);
    }

    public function deleteEventHasUser(int $id): \Illuminate\Http\JsonResponse
    {
        $eventHasUser = EventHasUser::find($id);
        if (!$eventHasUser) {
            return response()->json(['status' => false, 'message' => 'Event/User Relation not found']);
        }
        $eventHasUser->delete();
        return response()->json(['status' => true, 'message' => 'Event/User Relation deleted']);
    }

    public function getSubscribe(Request $request): \Illuminate\Http\JsonResponse
    {
        $event = Event::where('is_current', true)->first();
        if (!$event) {
            return response()->json(['status' => true, 'subscribe' => 0]);
        }
        $eventHasUser = EventHasUser::where('event_id', $event->event_id)->where('user_id', $request->user()->id)->first();
        if (!$eventHasUser) {
            return response()->json(['status' => true, 'subscribe' => 0]);
        }
        return response()->json(['status' => true, "subscribe" => 1]);
    }

    public function updateSubscribe(Request $request): \Illuminate\Http\JsonResponse
    {
        $event = Event::where('is_current', true)->first();
        if (!$event) {
            return response()->json(['status' => false, 'message' => 'Current event not found']);
        }
        $subscribe = intval($request->post('subscribe', 0));
        $eventHasUser = EventHasUser::where('event_id', $event->event_id)->where('user_id', $request->user()->id)->first();
        if ($subscribe) {
            if (!$eventHasUser) {
                $eventHasUser = new EventHasUser();
                $eventHasUser->event_id = (int) $event->event_id;
                $eventHasUser->user_id = (int) $request->user()->id;
                $eventHasUser->visible = 1;
                $eventHasUser->position = 1;
                $eventHasUser->save();
                $userData = $request->user();
                $eventData = $eventHasUser->event()->first();
                try {
                    Mail::to($userData->email)->send(new EventSubscribe($userData, config('constants.MAIL_FROM_ADDRESS'), $eventData));
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        } else {
            if ($eventHasUser) {
                $eventData = $eventHasUser->event()->first();
                $eventHasUser->delete();

                $lectureSubscriptions = LectureHasUser::where('user_id', $request->user()->id)
                    ->whereHas('lecture.slot.schedule', function ($query) use ($eventData) {
                        $query->where('event_id', $eventData->event_id);
                    })->get();

                foreach ($lectureSubscriptions as $subscription) {
                    $subscription->delete();
                }

                $userData = $request->user();

                try {
                    Mail::to($userData->email)->send(new EventUnsubscribe($userData, config('constants.MAIL_FROM_ADDRESS'), $eventData));
                } catch (\Exception $e) {
                    Log::error($e->getMessage());
                }
            }
        }
        return response()->json(['status' => true]);
    }
}
