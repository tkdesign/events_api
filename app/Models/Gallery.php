<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $primaryKey = 'gallery_id';

    protected $fillable = [
        'event_id',
        'title',
        'short_desc',
        'desc'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'gallery_id', 'gallery_id');
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }
}
