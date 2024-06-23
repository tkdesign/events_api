<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    //
    public function getSponsors(): JsonResponse
    {
        $sponsors = Sponsor::query()
            ->join('events_has_sponsors', 'sponsors.sponsor_id', '=', 'events_has_sponsors.sponsor_id')
            ->join('events', 'events.event_id', '=', 'events_has_sponsors.event_id')
            ->where('events.is_current', true)
            ->get();
        $sponsors_data = [
            'sponsors' => $sponsors
        ];
        return response()->json($sponsors_data);
    }

    public function getSponsorsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[name]=asdasd
        */
        $sponsors = Sponsor::query()
            ->where('name', 'like', '%' . $request->input('search.name', '') . '%')
            ->orderBy($request->get('sortBy', 'sponsor_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($sponsors);
    }

    public function getSponsorsAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $sponsors = Sponsor::query()
            ->orderBy($request->get('sortBy', 'sponsor_id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($sponsors);
    }

    public function getSponsorAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['status' => false, 'message' => 'Sponsor not found']);
        }
        return response()->json($sponsor);
    }

    public function updateSponsor(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('name') || !$request->has('email')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('sponsor_id') && $request->post('sponsor_id') > 0) {
            $images_folder = 'images/sponsors';
            $sponsor = Sponsor::find($request->post('sponsor_id'));
            if (!$sponsor) {
                return response()->json(['status' => false, 'message' => 'Sponsor not found']);
            }
            $sponsor->name = $request->post('name', '');
            $sponsor->short_desc = $request->post('short_desc', '');
            $sponsor->desc = $request->post('desc', '');
            if($request->hasFile('logo')) {
                if($sponsor->logo) {
                    Storage::delete(public_path($sponsor->logo));
                }
                $image = $request->file('logo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($images_folder), $imageName);
                $sponsor->logo = "/$images_folder/".$imageName;
            }
            $sponsor->url = $request->post('url', '');
            $sponsor->email = $request->post('email', '');
            $sponsor->phone = $request->post('phone', '');
            $sponsor->save();
            return response()->json($sponsor);
        }
        return response()->json(['status' => false, 'message' => 'Sponsor not found']);
    }

    public function createSponsor(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('name') || !$request->has('email')) {
            return response()->json(['message' => 'Missing required fields'], 400);
        }
        $images_folder = 'images/sponsors';

        $sponsor = new Sponsor();
        $sponsor->name = $request->post('name', '');
        $sponsor->short_desc = $request->post('short_desc', '');
        $sponsor->desc = $request->post('desc', '');
        if($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($images_folder), $imageName);
            $sponsor->logo = "/$images_folder/".$imageName;
        }
        $sponsor->url = $request->post('url', '');
        $sponsor->email = $request->post('email', '');
        $sponsor->phone = $request->post('phone', '');

        $sponsor->save();

        return response()->json($sponsor);
    }

    public function deleteSponsor(int $id): \Illuminate\Http\JsonResponse
    {
        $sponsor = Sponsor::find($id);
        if (!$sponsor) {
            return response()->json(['status' => false, 'message' => 'Sponsor not found']);
        }
        $sponsor->delete();
        return response()->json(['status' => false, 'message' => 'Sponsor deleted']);
    }
}
