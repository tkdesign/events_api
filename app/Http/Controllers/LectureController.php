<?php

namespace App\Http\Controllers;

use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LectureController extends Controller
{
    //
    public function getLecturesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[title]=ssdf&search[capacity]=20
        */
        $lectures = Lecture::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->where('capacity', 'like', '%' . $request->input('search.capacity', '') . '%')
            ->orderBy($request->get('sortBy', 'lecture_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($lectures);
    }

    public function getLecturesAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $lectures = Lecture::query()
            ->orderBy($request->get('sortBy', 'lecture_id'), $request->get('sortOrder', 'asc'))
            ->get(['lecture_id', 'title']);
        return response()->json($lectures);
    }

    public function getLectureAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $lecture = Lecture::find($id);
        if (!$lecture) {
            return response()->json(['status' => false, 'message' => 'lecture not found']);
        }
        return response()->json($lecture);
    }

    public function updateLecture(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('lecture_id') && $request->post('lecture_id') > 0) {
            $lectures_folder = 'images/lectures';
            $lecture = Lecture::find($request->post('lecture_id'));
            if (!$lecture) {
                return response()->json(['status' => false, 'message' => 'lecture not found']);
            }
            $lecture->title = $request->post('title');
            $lecture->short_desc = $request->post('short_desc', '');
            $lecture->desc = $request->post('desc', '');
            if($request->hasFile('image')) {
                if($lecture->image) {
                    Storage::delete(public_path($lecture->image));
                }
                $lectureFile = $request->file('image');
                $lectureFileName = time().'.'.$lectureFile->getClientOriginalExtension();
                $lectureFile->move(public_path($lectures_folder), $lectureFileName);
                $lecture->image = "/$lectures_folder/".$lectureFileName;
            }
            $lecture->capacity = $request->post('capacity', 0);
            $lecture->save();
            return response()->json($lecture);
        }
        return response()->json(['status' => false, 'message' => 'lecture not found']);
    }

    public function createLecture(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $lectures_folder = 'images/lectures';

        $lecture = new Lecture();
        $lecture->title = $request->post('title');
        $lecture->short_desc = $request->post('short_desc', '');
        $lecture->desc = $request->post('desc', '');
        if($request->hasFile('image')) {
            $lectureFile = $request->file('image');
            $lectureFileName = time().'.'.$lectureFile->getClientOriginalExtension();
            $lectureFile->move(public_path($lectures_folder), $lectureFileName);
            $lecture->image = "/$lectures_folder/".$lectureFileName;
        }
        $lecture->capacity = $request->post('capacity', 0);

        $lecture->save();

        return response()->json($lecture);
    }

    public function deleteLecture(int $id): \Illuminate\Http\JsonResponse
    {
        $lecture = Lecture::find($id);
        if (!$lecture) {
            return response()->json(['status' => false, 'message' => 'lecture not found']);
        }
        $lecture->delete();
        return response()->json(['status' => true, 'message' => 'lecture deleted']);
    }

}
