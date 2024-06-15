<?php

namespace App\Http\Controllers;

use App\Models\LectureHasUser;
use Illuminate\Http\Request;

class LectureHasUserController extends Controller
{
    //
    public function getLecturesHasUsersAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[lecture_title]=asd&search[user_name]=asdfdfsd
        */
        $lecturesHasUsers = LectureHasUser::query()
            ->whereHas('lecture', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('search.lecture_title', '') . '%');
            })
            ->whereHas('user', function ($query) use ($request) {
                $query->where('first_name', 'like', '%' . $request->input('search.user_name', '') . '%')->orWhere('last_name', 'like', '%' . $request->input('search.user_name', '') . '%');
            })
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($lecturesHasUsers as &$item) {
            $item->setRelation('lecture', $item->lecture()->first(['lecture_id', 'title']));
            $item->setRelation('user', $item->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
        }
        return response()->json($lecturesHasUsers);
    }

    public function getLectureHasUserAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $lectureHasUser = LectureHasUser::find($id);
        if (!$lectureHasUser) {
            return response()->json(['status' => false, 'message' => 'Lecture/User Relation not found']);
        }
        $lectureHasUser->setRelation('lecture', $lectureHasUser->lecture()->first(['lecture_id', 'title']));
        $lectureHasUser->setRelation('user', $lectureHasUser->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
        return response()->json($lectureHasUser);
    }

    public function updateLectureHasUser(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('lecture_id') || !$request->has('user_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $lectureHasUser = LectureHasUser::find($request->post('id'));
            if (!$lectureHasUser) {
                return response()->json(['status' => false, 'message' => 'Lecture/User Relation not found']);
            }
            $lectureHasUser->lecture_id = $request->post('lecture_id', 0);
            $lectureHasUser->user_id = $request->post('user_id', 0);
            $lectureHasUser->visible = $request->post('visible', 1);
            $lectureHasUser->position = $request->post('position', 1);
            $lectureHasUser->save();
            $lectureHasUser->setRelation('lecture', $lectureHasUser->lecture()->first(['lecture_id', 'title']));
            $lectureHasUser->setRelation('user', $lectureHasUser->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
            return response()->json($lectureHasUser);
        }
        return response()->json(['status' => false, 'message' => 'Lecture/User Relation not found']);
    }

    public function createLectureHasUser(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('lecture_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $lectureHasUser = new LectureHasUser();
        $lectureHasUser->lecture_id = $request->post('lecture_id', 0);
        $lectureHasUser->user_id = $request->post('user_id', 0);
        $lectureHasUser->visible = $request->post('visible', 1);
        $lectureHasUser->position = $request->post('position', 1);
        $lectureHasUser->save();
        $lectureHasUser->setRelation('lecture', $lectureHasUser->lecture()->first(['lecture_id', 'title']));
        $lectureHasUser->setRelation('user', $lectureHasUser->user()->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->first());
        return response()->json($lectureHasUser);
    }

    public function deleteLectureHasUser(int $id): \Illuminate\Http\JsonResponse
    {
        $lectureHasUser = LectureHasUser::find($id);
        if (!$lectureHasUser) {
            return response()->json(['status' => false, 'message' => 'Lecture/User Relation not found']);
        }
        $lectureHasUser->delete();
        return response()->json(['status' => true, 'message' => 'Lecture/User Relation deleted']);
    }
}
