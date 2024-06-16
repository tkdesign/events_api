<?php

namespace App\Http\Controllers;

use App\Mail\EventSubscribe;
use App\Mail\UserRegister;
use App\Models\Event;
use App\Models\EventHasUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function checkAuth(Request $request)
    {
        return response()->json(['status' => true, 'auth' => auth()->check() ? true : false]);
    }

    public function user(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => false, 'message' => 'User is not authenticated']);
        }
        return response()->json(['status' => true, 'user' => auth()->user()]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 1;
        $user->save();
        Mail::to($user->email)->send(new UserRegister($user, config('constants.MAIL_FROM_ADDRESS')));
        $event = Event::where('is_current', true)->first();
        if ($event) {
            $eventHasUser = new EventHasUser();
            $eventHasUser->event_id = $event->event_id;
            $eventHasUser->user_id = $user->id;
            $eventHasUser->visible = 1;
            $eventHasUser->position = 1;
            $eventHasUser->save();
            $eventData = $eventHasUser->event()->first();
            Mail::to($user->email)->send(new EventSubscribe($user, config('constants.MAIL_FROM_ADDRESS'), $eventData));
        }

        return response()->json(['status' => true, 'message' => 'User registered successfully']);
    }

    public function getUsersAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[first_name]=asd&search[last_name]=asdwee
        */
        $users = User::query()
            ->select(['id', 'name', 'email', 'first_name', 'last_name', 'role'])
            ->where('first_name', 'like', '%' . $request->input('search.first_name', '') . '%')
            ->where('last_name', 'like', '%' . $request->input('search.last_name', '') . '%')
            ->where('email', 'like', '%' . $request->input('search.email', '') . '%')
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($users);
    }

    public function getUsersAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $users = User::query()
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($users);
    }

    public function getUsersAllConcatAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $users = User::query()
            ->orderBy($request->get('sortBy', 'id'), $request->get('sortOrder', 'asc'))
            ->selectRaw('id, CONCAT(first_name, " ", last_name) AS user_name')->get();
        return response()->json($users);
    }


    public function getUserAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id)->select(['id', 'name', 'email', 'first_name', 'last_name', 'role']);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
        return response()->json($user);
    }

    public function updateUser(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('name') || !$request->has('email')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('id') && $request->post('id') > 0) {
            $user = User::find($request->post('id'));
            if (!$user) {
                return response()->json(['status' => false, 'message' => 'User not found']);
            }
            $user->name = $request->post('name', '');
            if ($request->has('password')) {
                $user->password = bcrypt($request->post('password', ''));
            }
            $user->first_name = $request->post('first_name', '');
            $user->last_name = $request->post('last_name', '');
            $user->email = $request->post('email', '');
            $user->role = (int) $request->post('role', 1);

            $user->save();
            return response()->json($user);
        }
        return response()->json(['status' => false, 'message' => 'User not found']);
    }

    public function createUser(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('name') || !$request->has('email') || !$request->has('password')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }

        $user = new User();
        $user->name = $request->post('name', '');
        $user->email = $request->post('email', '');
        $user->email_verified_at = now();
        $user->password = bcrypt($request->post('password', ''));
        $user->remember_token = Str::random(10);
        $user->first_name = $request->post('first_name', '');
        $user->last_name = $request->post('last_name', '');
        $user->role = (int) $request->post('role', 1);
        $user->save();

        return response()->json($user);
    }

    public function deleteUser(int $id): \Illuminate\Http\JsonResponse
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }
        $user->delete();
        return response()->json(['status' => true, 'message' => 'User deleted']);
    }
}
