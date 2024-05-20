<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

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
}
