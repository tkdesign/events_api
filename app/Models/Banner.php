<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $primaryKey = 'banner_id';

    protected $fillable = [
        'title',
        'content',
        'image',
        'thumbnail',
        'color',
        'text_color',
        'event_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function event() {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }
}
