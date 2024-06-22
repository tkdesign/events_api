<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $primaryKey = 'article_id';

    protected $fillable = [
        'menu_item_id',
        'title',
        'short_desc',
        'desc',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function menuItem()
    {
        return $this->hasOne(MenuItem::class, 'menu_item_id', 'menu_item_id');
    }
}
