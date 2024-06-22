<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @return int[]
     */
    public function getUserRoles(): array
    {
        $roles = [-1];
        if (Auth()->check()) {
            switch (auth()->user()->role) {
                case 1:
                    $roles = array_merge($roles, [1]);
                    break;
                case 2:
                    $roles = array_merge($roles, [1, 2]);
                    break;
                default:
                    $roles = array_merge($roles, [0]);
            }
        } else {
            $roles = array_merge($roles, [0]);
        }

        return $roles;
    }

}
