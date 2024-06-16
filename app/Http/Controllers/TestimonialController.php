<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    //
    public function getCurrentEventTestimonials(): \Illuminate\Http\JsonResponse
    {
        $testimonials = Testimonial::query()
            ->select(['testimonials.testimonial_id','testimonials.desc', 'testimonials.image', 'testimonials.thumbnail', 'testimonials.rating', 'users.first_name','users.last_name'])
            ->join('events', 'events.event_id', '=', 'testimonials.event_id')
            ->join('users', 'users.id', '=', 'testimonials.user_id')
            ->where('testimonials.visible', true)
            ->where('events.is_current', true)
            ->get();
        $testimonials_data = [
            'testimonials' => $testimonials
        ];
        return response()->json($testimonials_data);
    }

    public function getTestimonialsAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[rating]=5
        */
        $testimonials = Testimonial::query()
            ->where('rating', 'like', '%' . $request->input('search.rating', '') . '%')
            ->orderBy($request->get('sortBy', 'testimonial_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($testimonials as &$item) {
            $item->setRelation('user', $item->user()->first(['id', 'name']));
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
        }
        return response()->json($testimonials);
    }

    public function getTestimonialAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['status' => false, 'message' => 'Testimonial not found']);
        }
        $testimonial->setRelation('user', $testimonial->user()->first(['id', 'name']));
        $testimonial->setRelation('event', $testimonial->event()->first(['event_id', 'title']));
        return response()->json($testimonial);
    }

    public function updateTestimonial(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('user_id') || !$request->has('event_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('testimonial_id') && $request->post('testimonial_id') > 0) {
            $testimonials_folder = 'images/testimonials';
            $testimonial = Testimonial::find($request->post('testimonial_id'));
            if (!$testimonial) {
                return response()->json(['status' => false, 'message' => 'Testimonial not found']);
            }
            $testimonial->user_id = (int) $request->post('user_id', 0);
            $testimonial->event_id = (int) $request->post('event_id', 0);
            $testimonial->desc = $request->post('desc', '');
            if($request->hasFile('image')) {
                if($testimonial->image) {
                    Storage::delete(public_path($testimonial->image));
                }
                $testimonialFile = $request->file('image');
                $testimonialName = time().'.'.$testimonialFile->getClientOriginalExtension();
                $testimonialFile->move(public_path($testimonials_folder), $testimonialName);
                $testimonial->image = "/$testimonials_folder/".$testimonialName;
            }
            if($request->hasFile('thumbnail')) {
                if($testimonial->thumbnail) {
                    Storage::delete(public_path($testimonial->thumbnail));
                }
                $testimonialFile = $request->file('thumbnail');
                $testimonialName = time().'.'.$testimonialFile->getClientOriginalExtension();
                $testimonialFile->move(public_path($testimonials_folder), $testimonialName);
                $testimonial->thumbnail = "/$testimonials_folder/".$testimonialName;
            }
            $testimonial->rating = (int) $request->post('rating', 5);
            $testimonial->visible = (int) $request->post('visible', 1);
            $testimonial->position = (int) $request->post('position', 1);
            $testimonial->save();
            $testimonial->setRelation('user', $testimonial->user()->first(['id', 'name']));
            $testimonial->setRelation('event', $testimonial->event()->first(['event_id', 'title']));
            return response()->json($testimonial);
        }
        return response()->json(['status' => false, 'message' => 'Testimonial not found']);
    }

    public function createTestimonial(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('user_id') || !$request->has('event_id') || !$request->has('image') || !$request->has('thumbnail')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $testimonials_folder = 'images/testimonials';

        $testimonial = new Testimonial();
        $testimonial->user_id = (int) $request->post('user_id', 0);
        $testimonial->event_id = (int) $request->post('event_id', 0);
        $testimonial->desc = $request->post('desc', '');
        if($request->hasFile('image')) {
            $testimonialFile = $request->file('image');
            $testimonialName = time().'.'.$testimonialFile->getClientOriginalExtension();
            $testimonialFile->move(public_path($testimonials_folder), $testimonialName);
            $testimonial->image = "/$testimonials_folder/".$testimonialName;
        }
        if($request->hasFile('thumbnail')) {
            $testimonialFile = $request->file('thumbnail');
            $testimonialName = time().'.'.$testimonialFile->getClientOriginalExtension();
            $testimonialFile->move(public_path($testimonials_folder), $testimonialName);
            $testimonial->thumbnail = "/$testimonials_folder/".$testimonialName;
        }
        $testimonial->rating = (int) $request->post('rating', 5);
        $testimonial->visible = (int) $request->post('visible', 1);
        $testimonial->position = (int) $request->post('position', 1);

        $testimonial->save();
        $testimonial->setRelation('user', $testimonial->user()->first(['id', 'name']));
        $testimonial->setRelation('event', $testimonial->event()->first(['event_id', 'title']));

        return response()->json($testimonial);
    }

    public function deleteTestimonial(int $id): \Illuminate\Http\JsonResponse
    {
        $testimonial = Testimonial::find($id);
        if (!$testimonial) {
            return response()->json(['status' => false, 'message' => 'Testimonial not found']);
        }
        $testimonial->delete();
        return response()->json(['status' => true, 'message' => 'Testimonial deleted']);
    }
}
