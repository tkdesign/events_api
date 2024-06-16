<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StageController extends Controller
{
    //
    public function getStagesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[title]=asd&search[location]=asdwee
        */
        $stage = Stage::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->where('location', 'like', '%' . $request->input('search.location', '') . '%')
            ->orderBy($request->get('sortBy', 'stage_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($stage);
    }

    public function getStagesAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $stage = Stage::query()
            ->orderBy($request->get('sortBy', 'stage_id'), $request->get('sortOrder', 'asc'))
            ->get(['stage_id', 'title']);
        return response()->json($stage);
    }

    public function getStageAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $stage = Stage::find($id);
        if (!$stage) {
            return response()->json(['status' => false, 'message' => 'Stage not found']);
        }
        return response()->json($stage);
    }

    public function updateStage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('stage_id') && $request->post('stage_id') > 0) {
            $stage = Stage::find($request->post('stage_id'));
            if (!$stage) {
                return response()->json(['status' => false, 'message' => 'Stage not found']);
            }
            $stage->title = $request->post('title', '');
            $stage->location = $request->post('location', '');
            $stage->max_capacity = (int) $request->post('max_capacity', 0);

            $stage->save();
            return response()->json($stage);
        }
        return response()->json(['status' => false, 'message' => 'Stage not found']);
    }

    public function createStage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }

        $stage = new Stage();
        $stage->title = $request->post('title', '');
        $stage->location = $request->post('location', '');
        $stage->max_capacity = (int) $request->post('max_capacity', 0);

        $stage->save();

        return response()->json($stage);
    }

    public function deleteStage(int $id): \Illuminate\Http\JsonResponse
    {
        $stage = Stage::find($id);
        if (!$stage) {
            return response()->json(['status' => false, 'message' => 'Stage not found']);
        }
        $stage->delete();
        return response()->json(['status' => true, 'message' => 'Stage deleted']);
    }

}
