<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $table = 'sponsors';

    protected $primaryKey = 'sponsor_id';

    protected $fillable = [
        'name',
        'short_desc',
        'desc',
        'logo',
        'url',
        'email',
        'phone'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_has_sponsors', 'sponsor_id', 'event_id')
            ->withPivot('visible', 'position')
            ->withTimestamps();
    }
}
