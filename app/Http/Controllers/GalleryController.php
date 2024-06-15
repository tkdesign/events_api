<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;

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

    public function getGalleriesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[title]=asd
        */
        $galleries = Gallery::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->orderBy($request->get('sortBy', 'gallery_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($galleries as &$item) {
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
        }
        return response()->json($galleries);
    }

    public function getGalleriesAllAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        $galleries = Gallery::query()
            ->orderBy($request->get('sortBy', 'gallery_id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($galleries);
    }

    public function getGalleryAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['status' => false, 'message' => 'Gallery not found']);
        }
        $gallery->setRelation($gallery->event()->first(['event_id', 'title']));
        return response()->json($gallery);
    }

    public function updateGallery(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('gallery_id') && $request->post('gallery_id') > 0) {
            $gallery = Gallery::find($request->post('gallery_id'));
            if (!$gallery) {
                return response()->json(['status' => false, 'message' => 'Gallery not found']);
            }
            $gallery->event_id = $request->post('event_id', 0);
            $gallery->title = $request->post('title', '');
            $gallery->short_desc = $request->post('short_desc', '');
            $gallery->desc = $request->post('desc', '');
            $gallery->save();
            $gallery->setRelation('event', $gallery->event()->first(['event_id', 'title']));
            return response()->json($gallery);
        }
        return response()->json(['status' => false, 'message' => 'Gallery not found']);
    }

    public function createGallery(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $gallery = new Gallery();
        $gallery->event_id = $request->post('event_id', 0);
        $gallery->title = $request->post('title', '');
        $gallery->short_desc = $request->post('short_desc', '');
        $gallery->desc = $request->post('desc', '');
        $gallery->save();
        $gallery->setRelation('event', $gallery->event()->first(['event_id', 'title']));
        return response()->json($gallery);
    }

    public function deleteGallery(int $id): \Illuminate\Http\JsonResponse
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['status' => false, 'message' => 'Gallery not found']);
        }
        $gallery->delete();
        return response()->json(['status' => true, 'message' => 'Gallery deleted']);
    }

}
