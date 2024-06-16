<?php

namespace App\Http\Controllers;

use App\Models\EventHasSponsor;
use Illuminate\Http\Request;

class EventHasSponsorController extends Controller
{
    //
    public function getEventsHasSponsorsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[event_title]=asd&search[sponsor_name]=asdasdsad
        */
        $eventsHasSponsors = EventHasSponsor::query()
            ->whereHas('event', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.event_title', '') . '%');
            })
            ->whereHas('sponsor', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('search.sponsor_name', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($eventsHasSponsors as &$item) {
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
            $item->setRelation('sponsor', $item->sponsor()->first(['sponsor_id', 'name']));
        }
        return response()->json($eventsHasSponsors);
    }

    public function getEventHasSponsorAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $eventHasSponsor = EventHasSponsor::find($id);
        if (!$eventHasSponsor) {
            return response()->json(['status' => false, 'message' => 'Event/Sponsor Relation not found']);
        }
        $eventHasSponsor->setRelation('event', $eventHasSponsor->event()->first(['event_id', 'title']));
        $eventHasSponsor->setRelation('sponsor', $eventHasSponsor->sponsor()->first(['sponsor_id', 'name']));
        return response()->json($eventHasSponsor);
    }

    public function updateEventHasSponsor(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id') || !$request->has('sponsor_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $eventHasSponsor = EventHasSponsor::find($request->post('id'));
            if (!$eventHasSponsor) {
                return response()->json(['status' => false, 'message' => 'Event/Sponsor Relation not found']);
            }
            $eventHasSponsor->event_id = (int) $request->post('event_id', 0);
            $eventHasSponsor->sponsor_id = (int) $request->post('sponsor_id', 0);
            $eventHasSponsor->visible = (int) $request->post('visible', 1);
            $eventHasSponsor->position = (int) $request->post('position', 1);
            $eventHasSponsor->save();
            $eventHasSponsor->setRelation('event', $eventHasSponsor->event()->first(['event_id', 'title']));
            $eventHasSponsor->setRelation('sponsor', $eventHasSponsor->sponsor()->first(['sponsor_id', 'name']));
            return response()->json($eventHasSponsor);
        }
        return response()->json(['status' => false, 'message' => 'Event/Sponsor Relation not found']);
    }

    public function createEventHasSponsor(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $eventHasSponsor = new EventHasSponsor();
        $eventHasSponsor->event_id = (int) $request->post('event_id', 0);
        $eventHasSponsor->sponsor_id = (int) $request->post('sponsor_id', 0);
        $eventHasSponsor->visible = (int) $request->post('visible', 1);
        $eventHasSponsor->position = (int) $request->post('position', 1);
        $eventHasSponsor->save();
        $eventHasSponsor->setRelation('event', $eventHasSponsor->event()->first(['event_id', 'title']));
        $eventHasSponsor->setRelation('sponsor', $eventHasSponsor->sponsor()->first(['sponsor_id', 'name']));
        return response()->json($eventHasSponsor);
    }

    public function deleteEventHasSponsor(int $id): \Illuminate\Http\JsonResponse
    {
        $eventHasSponsor = EventHasSponsor::find($id);
        if (!$eventHasSponsor) {
            return response()->json(['status' => false, 'message' => 'Event/Sponsor Relation not found']);
        }
        $eventHasSponsor->delete();
        return response()->json(['status' => true, 'message' => 'Event/Sponsor Relation deleted']);
    }
}
