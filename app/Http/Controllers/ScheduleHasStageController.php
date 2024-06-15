<?php

namespace App\Http\Controllers;

use App\Models\ScheduleHasStage;
use Illuminate\Http\Request;

class ScheduleHasStageController extends Controller
{
    //
    public function getSchedulesHasStagesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[stage_title]=asd
        */
        $schedulesHasStages = ScheduleHasStage::query()
            ->where('schedule_id', 'like', '%' . $request->input('search.schedule_id', '') . '%')
            ->whereHas('stage', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.stage_title', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($schedulesHasStages as &$item) {
            $item->setRelation('stage', $item->stage()->first(['stage_id', 'title']));
        }
        return response()->json($schedulesHasStages);
    }

    public function getScheduleHasStageAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $scheduleHasStage = ScheduleHasStage::find($id);
        if (!$scheduleHasStage) {
            return response()->json(['status' => false, 'message' => 'Schedule/Stage Relation not found']);
        }
        $scheduleHasStage->setRelation('stage', $scheduleHasStage->stage()->first(['stage_id', 'title']));
        return response()->json($scheduleHasStage);
    }

    public function updateScheduleHasStage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('schedule_id') || !$request->has('stage_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $scheduleHasStage = ScheduleHasStage::find($request->post('id'));
            if (!$scheduleHasStage) {
                return response()->json(['status' => false, 'message' => 'Schedule/Stage Relation not found']);
            }
            $scheduleHasStage->schedule_id = $request->post('schedule_id', 0);
            $scheduleHasStage->stage_id = $request->post('stage_id', 0);
            $scheduleHasStage->visible = $request->post('visible', 1);
            $scheduleHasStage->position = $request->post('position', 1);
            $scheduleHasStage->save();
            $scheduleHasStage->setRelation('stage', $scheduleHasStage->stage()->first(['stage_id', 'title']));
            return response()->json($scheduleHasStage);
        }
        return response()->json(['status' => false, 'message' => 'Schedule/Stage Relation not found']);
    }

    public function createScheduleHasStage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('schedule_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $scheduleHasStage = new ScheduleHasStage();
        $scheduleHasStage->schedule_id = $request->post('schedule_id', 0);
        $scheduleHasStage->stage_id = $request->post('stage_id', 0);
        $scheduleHasStage->visible = $request->post('visible', 1);
        $scheduleHasStage->position = $request->post('position', 1);
        $scheduleHasStage->save();
        $scheduleHasStage->setRelation('stage', $scheduleHasStage->stage()->first(['stage_id', 'title']));
        return response()->json($scheduleHasStage);
    }

    public function deleteScheduleHasStage(int $id): \Illuminate\Http\JsonResponse
    {
        $scheduleHasStage = ScheduleHasStage::find($id);
        if (!$scheduleHasStage) {
            return response()->json(['status' => false, 'message' => 'Schedule/Stage Relation not found']);
        }
        $scheduleHasStage->delete();
        return response()->json(['status' => true, 'message' => 'Schedule/Stage Relation deleted']);
    }
}
