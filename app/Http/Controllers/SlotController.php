<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    //
    public function getSlotsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[lecture_title]=asd&search[stage_title]=asdfdfsd&search[schedule_id]=2
        */
        $slots = Slot::query()
            ->where('schedule_id', 'like', '%' . $request->input('search.schedule_id', '') . '%')
            ->whereHas('lecture', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.lecture_title', '') . '%');
            })
            ->whereHas('stage', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.stage_title', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'slot_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($slots as &$item) {
            $item->setRelation('lecture', $item->lecture()->first(['lecture_id', 'title']));
            $item->setRelation('stage', $item->stage()->first(['stage_id', 'title']));
            $item->setRelation('schedule', $item->schedule()->first(['schedule_id']));
        }
        return response()->json($slots);
    }

    public function getSlotAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $slot = Slot::find($id);
        if (!$slot) {
            return response()->json(['status' => false, 'message' => 'Slot not found']);
        }
        $slot->setRelation('lecture', $slot->lecture()->first(['lecture_id', 'title']));
        $slot->setRelation('stage', $slot->stage()->first(['stage_id', 'title']));
        $slot->setRelation('schedule', $slot->schedule()->first(['schedule_id']));

        return response()->json($slot);
    }

    public function updateSlot(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('schedule_id') || !$request->has('stage_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('slot_id') && $request->post('slot_id') > 0) {
            $slot = Slot::find($request->post('slot_id'));
            if (!$slot) {
                return response()->json(['status' => false, 'message' => 'Slot not found']);
            }
            $slot->lecture_id = (int) $request->post('lecture_id', 0);
            $slot->stage_id = (int) $request->post('stage_id', 0);
            $slot->schedule_id = (int) $request->post('schedule_id', 0);
            $slot->day = $request->post('day', date('Y-m-d'));
            $slot->start_time = Carbon::parse($request->post('start_time', '00:00:00'))->toTimeString();
            $slot->end_time = Carbon::parse($request->post('end_time', '00:00:00'))->toTimeString();
            $slot->save();
            $slot->setRelation('lecture', $slot->lecture()->first(['lecture_id', 'title']));
            $slot->setRelation('stage', $slot->stage()->first(['stage_id', 'title']));
            $slot->setRelation('schedule', $slot->schedule()->first(['schedule_id']));
            return response()->json($slot);
        }
        return response()->json(['status' => false, 'message' => 'Slot not found']);
    }

    public function createSlot(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('schedule_id') || !$request->has('stage_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $slot = new Slot();
        $slot->lecture_id = (int) $request->post('lecture_id', 0);
        $slot->stage_id = (int) $request->post('stage_id', 0);
        $slot->schedule_id = (int) $request->post('schedule_id', 0);
        $slot->day = $request->post('day', date('Y-m-d'));
        $slot->start_time = Carbon::parse($request->post('start_time', '00:00:00'))->toTimeString();
        $slot->end_time = Carbon::parse($request->post('end_time', '00:00:00'))->toTimeString();
        $slot->save();
        $slot->setRelation('lecture', $slot->lecture()->first(['lecture_id', 'title']));
        $slot->setRelation('stage', $slot->stage()->first(['stage_id', 'title']));
        $slot->setRelation('schedule', $slot->schedule()->first(['schedule_id']));
        return response()->json($slot);
    }

    public function deleteSlot(int $id): \Illuminate\Http\JsonResponse
    {
        $slot = Slot::find($id);
        if (!$slot) {
            return response()->json(['status' => false, 'message' => 'Slot not found']);
        }
        $slot->delete();
        return response()->json(['status' => true, 'message' => 'Slot deleted']);
    }
}
