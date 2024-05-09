<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }

    public function schedules_has_stages()
    {
        return $this->hasMany(Schedules_has_stages::class);
    }
}
