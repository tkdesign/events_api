<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    //
    public function getCurrentEventBanners(): \Illuminate\Http\JsonResponse
    {
        $banners = Banner::query()
            ->select(['banners.banner_id','banners.content', 'banners.image', 'banners.thumbnail', 'banners.color', 'banners.text_color', 'banners.position', 'banners.visible', 'banners.event_id'])
            ->join('events', 'events.event_id', '=', 'banners.event_id')
            ->where('banners.visible', true)
            ->where('events.is_current', true)
            ->orderBy('banners.position', 'asc')
            ->get();
        $banners_data = [
            'banners' => $banners
        ];
        return response()->json($banners_data);
    }
    public function getBannersAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=10&search[title]=asdfsdf
        */
        $banners = Banner::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->orderBy($request->get('sortBy', 'banner_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        foreach ($banners as &$item) {
            $item->setRelation('event', $item->event()->first(['event_id', 'title']));
        }
        return response()->json($banners);
    }

    public function getBannerAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['status' => false, 'message' => 'Banner not found']);
        }
        $banner->setRelation('event', $banner->event()->first(['event_id', 'title']));
        return response()->json($banner);
    }

    public function updateBanner(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('banner_id') && $request->post('banner_id') > 0) {
            $banners_folder = 'images/banners';
            $banner = Banner::find($request->post('banner_id'));
            if (!$banner) {
                return response()->json(['status' => false, 'message' => 'Banner not found']);
            }
            $banner->event_id = (int) $request->post('event_id', 0);
            $banner->title = $request->post('title', '');
            $banner->content = $request->post('content', '');
            if($request->hasFile('image')) {
                if($banner->image) {
                    Storage::delete(public_path($banner->image));
                }
                $bannerFile = $request->file('image');
                $bannerName = time().'.'.$bannerFile->getClientOriginalExtension();
                $bannerFile->move(public_path($banners_folder), $bannerName);
                $banner->image = "/$banners_folder/".$bannerName;
            }
            if($request->hasFile('thumbnail')) {
                if($banner->thumbnail) {
                    Storage::delete(public_path($banner->thumbnail));
                }
                $bannerFile = $request->file('thumbnail');
                $bannerName = time().'.'.$bannerFile->getClientOriginalExtension();
                $bannerFile->move(public_path($banners_folder), $bannerName);
                $banner->thumbnail = "/$banners_folder/".$bannerName;
            }
            $banner->color = $request->post('color', '');
            $banner->text_color = $request->post('text_color', '');
            $banner->visible = (int) $request->post('visible', 1);
            $banner->position = (int) $request->post('position', 1);
            $banner->save();
            $banner->setRelation('event', $banner->event()->first(['event_id', 'title']));
            return response()->json($banner);
        }
        return response()->json(['status' => false, 'message' => 'Banner not found']);
    }

    public function createBanner(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('event_id')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        $banners_folder = 'images/banners';

        $banner = new Banner();
        $banner->event_id = (int) $request->post('event_id', 0);
        $banner->title = $request->post('title', '');
        $banner->content = $request->post('content', '');
        if($request->hasFile('image')) {
            $bannerFile = $request->file('image');
            $bannerName = time().'.'.$bannerFile->getClientOriginalExtension();
            $bannerFile->move(public_path($banners_folder), $bannerName);
            $banner->image = "/$banners_folder/".$bannerName;
        }
        if($request->hasFile('thumbnail')) {
            $bannerFile = $request->file('thumbnail');
            $bannerName = time().'.'.$bannerFile->getClientOriginalExtension();
            $bannerFile->move(public_path($banners_folder), $bannerName);
            $banner->thumbnail = "/$banners_folder/".$bannerName;
        }
        $banner->color = $request->post('color', '');
        $banner->text_color = $request->post('text_color', '');
        $banner->visible = (int) $request->post('visible', 1);
        $banner->position = (int) $request->post('position', 1);

        $banner->save();
        $banner->setRelation('event', $banner->event()->first(['event_id', 'title']));

        return response()->json($banner);
    }

    public function deleteBanner(int $id): \Illuminate\Http\JsonResponse
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(['status' => false, 'message' => 'Banner not found']);
        }
        $banner->delete();
        return response()->json(['status' => true, 'message' => 'Banner deleted']);
    }

}
