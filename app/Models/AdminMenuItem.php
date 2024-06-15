<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMenuItem extends Model
{
    use HasFactory;

    protected $table = 'admin_menu_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'title',
        'page_title',
        'path',
        'component',
        'visible',
        'position',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
