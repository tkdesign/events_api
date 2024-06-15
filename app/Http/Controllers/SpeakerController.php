<?php

namespace App\Http\Controllers;

use App\Models\Curator;
use App\Models\Speaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeakerController extends Controller
{
    //
    public function getCurrentEventSpeakers(): \Illuminate\Http\JsonResponse
    {
        $speakers = Speaker::query()
            ->select('speakers.*')
            ->join('lectures_has_speakers', 'speakers.speaker_id', '=', 'lectures_has_speakers.speaker_id')
            ->join('lectures', 'lectures.lecture_id', '=', 'lectures_has_speakers.lecture_id')
            ->join('slots', 'slots.lecture_id', '=', 'lectures.lecture_id')
            ->join('schedules', 'schedules.schedule_id', '=', 'slots.schedule_id')
            ->join('events', 'events.event_id', '=', 'schedules.event_id')
            ->where('events.is_current', true)
            ->get();
        $speakers_data = [
            'speakers' => $speakers
        ];
        return response()->json($speakers_data);
    }

    public function getSpeakersAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[first_name]=asd&search[last_name]=asdwee
        */
        $speakers = Speaker::query()
            ->where('first_name', 'like', '%' . $request->input('search.first_name', '') . '%')
            ->where('last_name', 'like', '%' . $request->input('search.last_name', '') . '%')
            ->orderBy($request->get('sortBy', 'speaker_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($speakers);
    }

    public function getSpeakersAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $speakers = Speaker::query()
            ->orderBy($request->get('sortBy', 'speaker_id'), $request->get('sortOrder', 'asc'))
            ->selectRaw('speaker_id, CONCAT(first_name, " ", last_name) AS speaker_name')->get();
        return response()->json($speakers);
    }

    public function getSpeakerAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return response()->json(['status' => false, 'message' => 'Speaker not found']);
        }
        return response()->json($speaker);
    }

    public function updateSpeaker(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('first_name') || !$request->has('email')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('speaker_id') && $request->post('speaker_id') > 0) {
            $images_folder = 'images/speakers';
            $speaker = Speaker::find($request->post('speaker_id'));
            if (!$speaker) {
                return response()->json(['status' => false, 'message' => 'Speaker not found']);
            }
            $speaker->titul = $request->post('titul', '');
            $speaker->first_name = $request->post('first_name', '');
            $speaker->last_name = $request->post('last_name', '');
            $speaker->company = $request->post('company', '');
            $speaker->occupation = $request->post('occupation', '');
            $speaker->short_desc = $request->post('short_desc', '');
            $speaker->desc = $request->post('desc', '');
            $speaker->email = $request->post('email', '');
            $speaker->phone = $request->post('phone', '');
            $speaker->facebook = $request->post('facebook', '');
            $speaker->instagram = $request->post('instagram', '');
            $speaker->linkedin = $request->post('linkedin', '');
            if($request->hasFile('image')) {
                if($speaker->image) {
                    Storage::delete(public_path($speaker->image));
                }
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($images_folder), $imageName);
                $speaker->image = "/$images_folder/".$imageName;
            }
            if($request->hasFile('thumbnail')) {
                if($speaker->thumbnail) {
                    Storage::delete(public_path($speaker->thumbnail));
                }
                $image = $request->file('thumbnail');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($images_folder), $imageName);
                $speaker->thumbnail = "/$images_folder/".$imageName;
            }
            $speaker->save();
            return response()->json($speaker);
        }
        return response()->json(['status' => false, 'message' => 'Speaker not found']);
    }

    public function createSpeaker(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('first_name')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $images_folder = 'images/speakers';

        $speaker = new Speaker();
        $speaker->titul = $request->post('titul', '');
        $speaker->first_name = $request->post('first_name', '');
        $speaker->last_name = $request->post('last_name', '');
        $speaker->short_desc = $request->post('short_desc', '');
        $speaker->desc = $request->post('desc', '');
        $speaker->company = $request->post('company', '');
        $speaker->occupation = $request->post('occupation', '');
        $speaker->phone = $request->post('phone', '');
        $speaker->email = $request->post('email', '');
        $speaker->facebook = $request->post('facebook', '');
        $speaker->instagram = $request->post('instagram', '');
        $speaker->linkedin = $request->post('linkedin', '');
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($images_folder), $imageName);
            $speaker->image = "/$images_folder/".$imageName;
        }
        if($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($images_folder), $imageName);
            $speaker->thumbnail = "/$images_folder/".$imageName;
        }

        $speaker->save();

        return response()->json($speaker);
    }

    public function deleteSpeaker(int $id): \Illuminate\Http\JsonResponse
    {
        $speaker = Speaker::find($id);
        if (!$speaker) {
            return response()->json(['status' => false, 'message' => 'Speaker not found']);
        }
        $speaker->delete();
        return response()->json(['status' => true, 'message' => 'Speaker deleted']);
    }
}
