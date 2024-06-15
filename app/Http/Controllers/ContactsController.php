<?php

namespace App\Http\Controllers;

use App\Models\Curator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ContactsController extends Controller
{
    //
    public function getCurators()
    {
        $curators = Curator::query()
            ->join('events_has_curators', 'curators.curator_id', '=', 'events_has_curators.curator_id')
            ->join('events', 'events.event_id', '=', 'events_has_curators.event_id')
            ->where('events.is_current', true)
            ->get();
        $curators_list = array();
        $curators_list[] = [
            'type' => 'subheader',
            'title' => 'Curators'
        ];
        $i = 0;
        foreach ($curators as $curator) {
            if ($i > 0) {
                $curators_list[] = [
                    'type' => 'divider',
                    'inset' => true
                ];
            }
            $curators_list[] = [
                'image' => $curator->photo_url,
                'title' => join(' ', array($curator->first_name, $curator->last_name)),
                'company' => $curator->company,
                'role' => $curator->occupation,
                'phone' => $curator->phone,
                'email' => $curator->email
            ];
            $i++;
        }
        $curators_data = ['curators' => $curators_list];
        return response()->json($curators_data);
    }

    public function getContactsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[first_name]=asd&search[last_name]=asdwee
        */
        $curator = Curator::query()
            ->where('first_name', 'like', '%' . $request->input('search.first_name', '') . '%')
            ->where('last_name', 'like', '%' . $request->input('search.last_name', '') . '%')
            ->orderBy($request->get('sortBy', 'curator_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($curator);
    }

    public function getContactsAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $curator = Curator::query()
            ->selectRaw('curator_id, CONCAT(first_name, " ", last_name) AS curator_name')
            ->orderBy($request->get('sortBy', 'curator_id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($curator);
    }

    public function getContactAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $curator = Curator::find($id);
        if (!$curator) {
            return response()->json(['status' => false, 'message' => 'Curator not found']);
        }
        return response()->json($curator);
    }

    public function updateContact(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('first_name')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('curator_id') && $request->post('curator_id') > 0) {
            $images_folder = 'images/curators';
            $curator = Curator::find($request->post('curator_id'));
            if (!$curator) {
                return response()->json(['status' => false, 'message' => 'Curator not found']);
            }
            $curator->titul = $request->post('titul', '');
            $curator->first_name = $request->post('first_name', '');
            $curator->last_name = $request->post('last_name', '');
            $curator->company = $request->post('company', '');
            $curator->occupation = $request->post('occupation', '');
            $curator->phone = $request->post('phone', '');
            $curator->email = $request->post('email', '');
            if($request->hasFile('photo_url')) {
                if($curator->photo_url) {
                    Storage::delete(public_path($curator->photo_url));
                }
                $image = $request->file('photo_url');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path($images_folder), $imageName);
                $curator->photo_url = "/$images_folder/".$imageName;
            }
            $curator->save();
            return response()->json($curator);
        }
        return response()->json(['status' => false, 'message' => 'Curator not found']);
    }

    public function createContact(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('first_name')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $images_folder = 'images/curators';

        $curator = new Curator();
        $curator->titul = $request->post('titul', '');
        $curator->first_name = $request->post('first_name', '');
        $curator->last_name = $request->post('last_name', '');
        $curator->company = $request->post('company', '');
        $curator->occupation = $request->post('occupation', '');
        $curator->phone = $request->post('phone', '');
        $curator->email = $request->post('email', '');
        if($request->hasFile('photo_url')) {
            $image = $request->file('photo_url');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path($images_folder), $imageName);
            $curator->photo_url = "/$images_folder/".$imageName;
        }

        $curator->save();

        return response()->json($curator);
    }

    public function deleteContact(int $id): \Illuminate\Http\JsonResponse
    {
        $curator = Curator::find($id);
        if (!$curator) {
            return response()->json(['status' => false, 'message' => 'Curator not found']);
        }
        $curator->delete();
        return response()->json(['status' => true, 'message' => 'Curator deleted']);
    }
}
