<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $fillable = [
        'title',
        'desc_short',
        'desc',
        'about_title',
        'about_text',
        'left_block_title',
        'left_block_text',
        'right_block_title',
        'right_block_text',
        'year',
        'start_date',
        'end_date',
        'image',
        'thumbnail',
        'map',
        'is_current',
        'location',
        'place',
        'address',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function activeEvent()
    {
        return $this->where('is_current', true)->first();
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'event_id', 'event_id')->where('is_current', true)->first();
    }

}
