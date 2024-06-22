<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'gallery_id',
        'title',
        'image',
        'thumbnail',
        'visible',
        'position'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
//        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'gallery_id', 'gallery_id');
    }
}
