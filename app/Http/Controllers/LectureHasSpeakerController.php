<?php

namespace App\Http\Controllers;

use App\Models\LectureHasSpeaker;
use Illuminate\Http\Request;

class LectureHasSpeakerController extends Controller
{
    //
    public function getLecturesHasSpeakersAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[lecture_title]=asd&search[speaker_name]=asdfdfsd
        */
        $lecturesHasSpeakers = LectureHasSpeaker::query()
            ->whereHas('lecture', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.lecture_title', '') . '%');
            })
            ->whereHas('speaker', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('search.speaker_name', '') . '%')->orWhere('last_name', 'like', '%' . $request->input('search.speaker_name', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($lecturesHasSpeakers as &$item) {
            $item->setRelation('lecture', $item->lecture()->first(['lecture_id', 'title']));
            $item->setRelation('speaker', $item->speaker()->selectRaw('speaker_id, CONCAT(first_name, " ", last_name) AS speaker_name')->first());
        }
        return response()->json($lecturesHasSpeakers);
    }

    public function getLectureHasSpeakerAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $lectureHasSpeaker = LectureHasSpeaker::find($id);
        if (!$lectureHasSpeaker) {
            return response()->json(['status' => false, 'message' => 'Lecture/Speaker Relation not found']);
        }
        $lectureHasSpeaker->setRelation('lecture', $lectureHasSpeaker->lecture()->first(['lecture_id', 'title']));
        $lectureHasSpeaker->setRelation('speaker', $lectureHasSpeaker->speaker()->selectRaw('speaker_id, CONCAT(first_name, " ", last_name) AS speaker_name')->first());
        return response()->json($lectureHasSpeaker);
    }

    public function updateLectureHasSpeaker(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('lecture_id') || !$request->has('speaker_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $lectureHasSpeaker = LectureHasSpeaker::find($request->post('id'));
            if (!$lectureHasSpeaker) {
                return response()->json(['status' => false, 'message' => 'lecture/Speaker Relation not found']);
            }
            $lectureHasSpeaker->lecture_id = (int) $request->post('lecture_id', 0);
            $lectureHasSpeaker->speaker_id = (int) $request->post('speaker_id', 0);
            $lectureHasSpeaker->visible = (int) $request->post('visible', 1);
            $lectureHasSpeaker->position = (int) $request->post('position', 1);
            $lectureHasSpeaker->save();
            $lectureHasSpeaker->setRelation('lecture', $lectureHasSpeaker->lecture()->first(['lecture_id', 'title']));
            $lectureHasSpeaker->setRelation('speaker', $lectureHasSpeaker->speaker()->selectRaw('speaker_id, CONCAT(first_name, " ", last_name) AS speaker_name')->first());
            return response()->json($lectureHasSpeaker);
        }
        return response()->json(['status' => false, 'message' => 'Lecture/Speaker Relation not found']);
    }

    public function createLectureHasSpeaker(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('lecture_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $lectureHasSpeaker = new LectureHasSpeaker();
        $lectureHasSpeaker->lecture_id = (int) $request->post('lecture_id', 0);
        $lectureHasSpeaker->speaker_id = (int) $request->post('speaker_id', 0);
        $lectureHasSpeaker->visible = (int) $request->post('visible', 1);
        $lectureHasSpeaker->position = (int) $request->post('position', 1);
        $lectureHasSpeaker->save();
        $lectureHasSpeaker->setRelation('lecture', $lectureHasSpeaker->lecture()->first(['lecture_id', 'title']));
        $lectureHasSpeaker->setRelation('speaker', $lectureHasSpeaker->speaker()->selectRaw('speaker_id, CONCAT(first_name, " ", last_name) AS speaker_name')->first());
        return response()->json($lectureHasSpeaker);
    }

    public function deleteLectureHasSpeaker(int $id): \Illuminate\Http\JsonResponse
    {
        $lectureHasSpeaker = LectureHasSpeaker::find($id);
        if (!$lectureHasSpeaker) {
            return response()->json(['status' => false, 'message' => 'Lecture/Speaker Relation not found']);
        }
        $lectureHasSpeaker->delete();
        return response()->json(['status' => true, 'message' => 'Lecture/Speaker Relation deleted']);
    }
}
