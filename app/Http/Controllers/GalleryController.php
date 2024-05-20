<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;

/*
        $galleries = [
            [
                'event_id' => 1,
                'title' => 'Web Dev 2022',
                'short_desc' => 'Web Dev 2022',
                'desc' => 'This is the gallery for the Web Dev 2022 conference.',
            ],
            [
                'event_id' => 2,
                'title' => 'Web Dev 2023',
                'short_desc' => 'Web Dev 2023',
                'desc' => 'This is the gallery for the Web Dev 2023 conference.',
            ],
            [
                'event_id' => 3,
                'title' => 'Web Dev 2024',
                'short_desc' => 'Web Dev 2024',
                'desc' => 'This is the gallery for the Web Dev 2024 conference.',
            ]
        ];

*/

class GalleryController extends Controller
{
    //
    public function getMenuGalleries(): \Illuminate\Http\JsonResponse
    {
        $galleries = Gallery::query()
            ->select(['galleries.gallery_id', 'events.year as value', 'events.year', 'galleries.title', 'galleries.short_desc', 'galleries.desc', 'events.is_current'])
            ->join('events', 'events.event_id', '=', 'galleries.event_id')
            ->orderBy('events.year', 'desc')
            ->get();
        $galleries_data = [
            'galleries' => $galleries
        ];
        return response()->json($galleries_data);
    }

    public function getImagesByGalleryId($gallery_id): \Illuminate\Http\JsonResponse
    {
        $images = Image::query()
            ->select(['image_id', 'title', 'image', 'thumbnail', 'gallery_id'])
            ->where('gallery_id', $gallery_id)
            ->where('visible', true)
            ->orderBy('position', 'asc')
            ->get();
        $images_data = [
            'images' => $images
        ];
        return response()->json($images_data);
    }
}
