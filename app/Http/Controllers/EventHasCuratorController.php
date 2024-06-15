<?php

namespace App\Http\Controllers;

use App\Models\EventHasCurator;
use Illuminate\Http\Request;

class EventHasCuratorController extends Controller
{
    //
    public function getEventsHasCuratorsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[event_title]=asd&search[curator_name]=asdasd
        */
        $eventsHasCurators = EventHasCurator::query()
            ->whereHas('event', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.event_title', '') . '%');
            })
            ->whereHas('curator', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('search.curator_name', '') . '%')->orWhere('last_name', 'like', '%' . $request->input('search.curator_name', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($eventsHasCurators as &$item) {
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
            $item->setRelation('curator', $item->curator()->selectRaw('curator_id, CONCAT(first_name, " ", last_name) AS curator_name')->first());
        }
        return response()->json($eventsHasCurators);
    }

    public function getEventHasCuratorAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $eventHasCurator = EventHasCurator::find($id);
        if (!$eventHasCurator) {
            return response()->json(['status' => false, 'message' => 'Event/Sponsor Relation not found']);
        }
        $eventHasCurator->setRelation('event', $eventHasCurator->event()->first(['event_id', 'title']));
        $eventHasCurator->setRelation('curator', $eventHasCurator->curator()->selectRaw('curator_id, CONCAT(first_name, " ", last_name) AS curator_name')->first());
        return response()->json($eventHasCurator);
    }

    public function updateEventHasCurator(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id') || !$request->has('curator_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $eventHasCurator = EventHasCurator::find($request->post('id'));
            if (!$eventHasCurator) {
                return response()->json(['status' => false, 'message' => 'Event/Curator Relation not found']);
            }
            $eventHasCurator->event_id = $request->post('event_id', 0);
            $eventHasCurator->curator_id = $request->post('curator_id', 0);
            $eventHasCurator->visible = $request->post('visible', 1);
            $eventHasCurator->position = $request->post('position', 1);
            $eventHasCurator->save();
            $eventHasCurator->setRelation('event', $eventHasCurator->event()->first(['event_id', 'title']));
            $eventHasCurator->setRelation('curator', $eventHasCurator->curator()->selectRaw('curator_id, CONCAT(first_name, " ", last_name) AS curator_name')->first());
            return response()->json($eventHasCurator);
        }
        return response()->json(['status' => false, 'message' => 'Event/Curator Relation not found']);
    }

    public function createEventHasCurator(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $eventHasCurator = new EventHasCurator();
        $eventHasCurator->event_id = $request->post('event_id', 0);
        $eventHasCurator->curator_id = $request->post('curator_id', 0);
        $eventHasCurator->visible = $request->post('visible', 1);
        $eventHasCurator->position = $request->post('position', 1);
        $eventHasCurator->save();
        $eventHasCurator->setRelation('event', $eventHasCurator->event()->first(['event_id', 'title']));
        $eventHasCurator->setRelation('curator', $eventHasCurator->curator()->selectRaw('curator_id, CONCAT(first_name, " ", last_name) AS curator_name')->first());
        return response()->json($eventHasCurator);
    }

    public function deleteEventHasCurator(int $id): \Illuminate\Http\JsonResponse
    {
        $eventHasCurator = EventHasCurator::find($id);
        if (!$eventHasCurator) {
            return response()->json(['status' => false, 'message' => 'Event/Curator Relation not found']);
        }
        $eventHasCurator->delete();
        return response()->json(['status' => true, 'message' => 'Event/Curator Relation deleted']);
    }
}
