<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    //
    public function getImagesAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[title]=asd
        */
        $images = Image::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->orderBy($request->get('sortBy', 'image_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($images as &$item) {
            $item->setRelation('gallery', $item->gallery()->first(['gallery_id', 'title']));
        }
        return response()->json($images);
    }

    public function getImageAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['status' => false, 'message' => 'Image not found']);
        }
        $image->setRelation('gallery', $image->gallery()->first(['gallery_id', 'title']));
        return response()->json($image);
    }

    public function updateImage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title') || !$request->has('gallery_id') || !$request->has('image') || !$request->has('thumbnail')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('image_id') && $request->post('image_id') > 0) {
            $images_folder = 'images/gallery';
            $image = Image::find($request->post('image_id'));
            if (!$image) {
                return response()->json(['status' => false, 'message' => 'Image not found']);
            }
            $image->gallery_id = $request->post('gallery_id', 0);
            $image->title = $request->post('title', '');
            if($request->hasFile('image')) {
                if($image->image) {
                    Storage::delete(public_path($image->image));
                }
                $imageFile = $request->file('image');
                $imageName = time().'.'.$imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($images_folder), $imageName);
                $image->image = "/$images_folder/".$imageName;
            }
            if($request->hasFile('thumbnail')) {
                if($image->thumbnail) {
                    Storage::delete(public_path($image->thumbnail));
                }
                $imageFile = $request->file('thumbnail');
                $imageName = time().'.'.$imageFile->getClientOriginalExtension();
                $imageFile->move(public_path($images_folder), $imageName);
                $image->thumbnail = "/$images_folder/".$imageName;
            }
            $image->visible = $request->post('visible', 1);
            $image->position = $request->post('position', 0);
            $image->save();
            $image->setRelation('gallery', $image->gallery()->first(['gallery_id', 'title']));
            return response()->json($image);
        }
        return response()->json(['status' => false, 'message' => 'Image not found']);
    }

    public function createImage(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title') || !$request->has('gallery_id') || !$request->has('image') || !$request->has('thumbnail')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $images_folder = 'images/gallery';

        $image = new Image();
        $image->gallery_id = $request->post('gallery_id', 0);
        $image->title = $request->post('title', '');
        if($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time().'.'.$imageFile->getClientOriginalExtension();
            $imageFile->move(public_path($images_folder), $imageName);
            $image->image = "/$images_folder/".$imageName;
        }
        if($request->hasFile('thumbnail')) {
            $imageFile = $request->file('thumbnail');
            $imageName = time().'.'.$imageFile->getClientOriginalExtension();
            $imageFile->move(public_path($images_folder), $imageName);
            $image->thumbnail = "/$images_folder/".$imageName;
        }
        $image->visible = $request->post('visible', 1);
        $image->position = $request->post('position', 0);

        $image->save();
        $image->setRelation('gallery', $image->gallery()->first(['gallery_id', 'title']));

        return response()->json($image);
    }

    public function deleteImage(int $id): \Illuminate\Http\JsonResponse
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['status' => false, 'message' => 'Image not found']);
        }
        $image->delete();
        return response()->json(['status' => true, 'message' => 'Image deleted']);
    }
}
