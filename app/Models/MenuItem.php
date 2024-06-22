<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $primaryKey = 'menu_item_id';

    protected $fillable = [
        'name',
        'title',
        'page_title',
        'path',
        'component',
        'visible',
        'position',
        'role',
        'is_article',
        'is_top_menu_item',
        'is_bottom_menu_item',
    ];

    protected $casts = [
//        'visible' => 'boolean',
//        'is_article' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
//        'is_top_menu_item' => 'boolean',
//        'is_bottom_menu_item' => 'boolean',
    ];
}
