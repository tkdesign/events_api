<?php

namespace App\Http\Controllers;

use App\Models\AdminMenuItem;
use Illuminate\Http\Request;

class AdminMenuItemController extends Controller
{
    //
    public function getMenu()
    {
        $menu = AdminMenuItem::query()
            ->where('visible', true)
            ->orderBy('position')
            ->get();
        $menu = $menu->toArray();
        return response()->json($menu);
    }
}
