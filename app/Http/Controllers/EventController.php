<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    //
    public function getCurrentEvent(): \Illuminate\Http\JsonResponse
    {
        $event = Event::where('is_current', true)->first();
        if (!$event) {
            return response()->json(['status' => false, 'message' => 'Current event not found']);
        }
        return response()->json($event);
    }

    public function getEventsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[title]=2&search[year]=24
        */
        $events = Event::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->where('year', 'like', '%' . $request->input('search.year', '') . '%')
            ->orderBy($request->get('sortBy', 'event_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($events);
    }

    public function getEventsAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $events = Event::query()
            ->orderBy($request->get('sortBy', 'event_id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($events);
    }

    public function getEventAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['status' => false, 'message' => 'Event not found']);
        }
        return response()->json($event);
    }

    public function updateEvent(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title') || !$request->has('year')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('event_id') && $request->post('event_id') > 0) {
            $images_folder = 'images/events';
            $event = Event::find($request->post('event_id'));
            if (!$event) {
                return response()->json(['status' => false, 'message' => 'Event not found']);
            }
            $event->title = $request->post('title', '');
            $event->desc_short = $request->post('desc_short', '');
            $event->desc = $request->post('desc', '');
            $event->year = (int) $request->post('year', 0);
            $event->start_date = Carbon::parse($request->post('start_date', ''))->toDateString();
            $event->end_date = Carbon::parse($request->post('end_date', ''))->toDateString();
            if($request->hasFile('image')) {
                if($event->image) {
                    Storage::delete(public_path($event->image));
                }
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($images_folder), $imageName);
                $event->image = "/$images_folder/".$imageName;
            }
            if($request->hasFile('thumbnail')) {
                if($event->thumbnail) {
                    Storage::delete(public_path($event->thumbnail));
                }
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time().'.'.$thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path($images_folder."/thumbnails"), $thumbnailName);
                $event->thumbnail = "/$images_folder/thumbnails/".$thumbnailName;
            }
            if ($request->input('is_current') == "false") {
                $event->is_current = false;
            } else {
                $event->is_current = !!$request->input('is_current', false);
            }
            $event->location = $request->post('location', '');
            $event->place = $request->post('place', '');
            $event->address = $request->post('address', '');
            $event->save();
            return response()->json($event);
        }
        return response()->json(['status' => false, 'message' => 'Event not found']);
    }

    public function createEvent(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title') || !$request->has('year')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $images_folder = 'images/events';

        $event = new Event();
        $event->title = $request->post('title', '');
        $event->desc_short = $request->post('desc_short', '');
        $event->desc = $request->post('desc', '');
        $event->year = (int) $request->post('year', now()->year);
        $event->start_date = Carbon::parse($request->post('start_date', ''))->toDateString();
        $event->end_date = Carbon::parse($request->post('end_date', ''))->toDateString();
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($images_folder), $imageName);
            $event->image = "/$images_folder/".$imageName;
        }
        if($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time().'.'.$thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path("$images_folder/thumbnails"), $thumbnailName);
            $event->thumbnail = "/$images_folder/thumbnails/".$thumbnailName;
        }
        if ($request->input('is_current') == "false") {
            $event->is_current = false;
        } else {
            $event->is_current = !!$request->input('is_current', false);
        }
        $event->location = $request->post('location', '');
        $event->place = $request->post('place', '');
        $event->address = $request->post('address', '');

        $event->save();

        return response()->json($event);
    }

    public function deleteEvent(int $id): \Illuminate\Http\JsonResponse
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['status' => false, 'message' => 'Event not found']);
        }
        $event->delete();
        return response()->json(['status' => true, 'message' => 'Event deleted']);
    }
}
