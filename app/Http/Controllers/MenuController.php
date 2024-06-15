<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Speaker;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    //
    public function getMenu()
    {

        $roles = $this->getUserRoles();

//        Log::info('roles: ' . json_encode($roles));

        $topMenu = MenuItem::query()
            ->select(array('name', 'title', 'page_title', 'path as alias', 'component', 'visible', 'position', 'role', 'is_article', 'is_top_menu_item', 'is_bottom_menu_item'))
            ->whereIn('role', $roles)
            ->where('is_top_menu_item', '=', true)
            ->orderBy('position')
            ->get()
            ->toArray();
        $bottomMenu = MenuItem::query()
            ->select(array('name', 'title', 'page_title', 'path as alias', 'component', 'visible', 'position', 'role', 'is_article', 'is_top_menu_item', 'is_bottom_menu_item'))
            ->whereIn('role', $roles)
            ->where('is_bottom_menu_item', '=', true)
            ->orderBy('position')
            ->get()
            ->toArray();


        $main_menu = [];
        foreach ($topMenu as $item) {
            $main_menu[] = $item;
        }
        $menu = [
            'menu' => $main_menu,
        ];
        $bottom_submenu_main = [];
        $bottom_submenu_topics = [];

        $bottom_submenu_main[] = [
            'type' => 'subheader',
            'title' => 'Main',
            'visible' => true
        ];
        $bottom_submenu_topics[] = [
            'type' => 'subheader',
            'title' => 'Topics',
            'visible' => true
        ];
        foreach ($bottomMenu as $item) {
            if ($item['is_top_menu_item'] && $item['is_bottom_menu_item']) {
                $bottom_submenu_main[] = $item;
            }
        }
        foreach ($bottomMenu as $item) {
            if (!$item['is_top_menu_item'] && $item['is_bottom_menu_item']) {
                $bottom_submenu_topics[] = $item;
            }
        }
        $menu['bottom_menu'] = array_merge($bottom_submenu_main, $bottom_submenu_topics);
        return response()->json($menu);
    }

    public function getMenuAdmin(Request $request): \Illuminate\Http\JsonResponse
    {
        /*
        page=1&itemsPerPage=5&search[title]=asd&search[component]=asdwee
        */
        $menu_item = MenuItem::query()
            ->where('title', 'like', '%' . $request->input('search.title', '') . '%')
            ->where('component', 'like', '%' . $request->input('search.component', '') . '%')
            ->orderBy($request->get('sortBy', 'menu_item_id'), $request->get('sortOrder', 'asc'))
            ->paginate($request->get('itemsPerPage', 10), ['*'], 'page', $request->get('page', 1));
        return response()->json($menu_item);
    }

    public function getMenuAdminAll(Request $request): \Illuminate\Http\JsonResponse
    {
        $menu_item = MenuItem::query()
            ->orderBy($request->get('sortBy', 'menu_item_id'), $request->get('sortOrder', 'asc'))
            ->get();
        return response()->json($menu_item);
    }

    public function getMenuItemAdmin(int $id): \Illuminate\Http\JsonResponse
    {
        $menu_item = MenuItem::find($id);
        if (!$menu_item) {
            return response()->json(['status' => false, 'message' => 'Menu item not found']);
        }
        return response()->json($menu_item);
    }

    public function updateMenuItem(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title') || !$request->has('path') || !$request->has('component')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }
        if($request->has('menu_item_id') && $request->post('menu_item_id') > 0) {
            $menu_item = MenuItem::find($request->post('menu_item_id'));
            if (!$menu_item) {
                return response()->json(['status' => false, 'message' => 'Menu item not found']);
            }
            Log::info('menu_item: ' . json_encode($menu_item));
            $menu_item->name = $request->post('name', '');
            $menu_item->title = $request->post('title', '');
            $menu_item->page_title = $request->post('page_title', '');
            $menu_item->path = $request->post('path', '');
            $menu_item->component = $request->post('component', '');
            $menu_item->visible = $request->post('visible', true);
            $menu_item->position = $request->post('position', 1);
            $menu_item->role = $request->post('role', -1);
            $menu_item->is_article = $request->post('is_article', false);
            $menu_item->is_top_menu_item = $request->post('is_top_menu_item', true);
            $menu_item->is_bottom_menu_item = $request->post('is_bottom_menu_item', true);

            $menu_item->save();
            return response()->json($menu_item);
        }
        return response()->json(['status' => false, 'message' => 'Menu item not found']);
    }

    public function createMenuItem(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->has('title') || !$request->has('path') || !$request->has('component')) {
            return response()->json(['status' => false, 'message' => 'Missing required fields']);
        }

        $menu_item = new MenuItem();
        $menu_item->name = $request->post('name', '');
        $menu_item->title = $request->post('title', '');
        $menu_item->page_title = $request->post('page_title', '');
        $menu_item->path = $request->post('path', '');
        $menu_item->component = $request->post('component', '');
        $menu_item->visible = $request->post('visible', 1);
        $menu_item->position = $request->post('position', 1);
        $menu_item->role = $request->post('role', -1);
        $menu_item->is_article = $request->post('is_article', 0);
        $menu_item->is_top_menu_item = $request->post('is_top_menu_item', 1);
        $menu_item->is_bottom_menu_item = $request->post('is_bottom_menu_item', 1);

        $menu_item->save();

        return response()->json($menu_item);
    }

    public function deleteMenuItem(int $id): \Illuminate\Http\JsonResponse
    {
        $menu_item = MenuItem::find($id);
        if (!$menu_item) {
            return response()->json(['status' => false, 'message' => 'Menu item not found']);
        }
        $menu_item->delete();
        return response()->json(['status' => true, 'message' => 'Menu item deleted']);
    }
}
