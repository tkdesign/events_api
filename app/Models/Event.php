<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function events_has_users()
    {
        return $this->hasMany(Events_has_users::class);
    }

    public function testimonails()
    {
        return $this->hasMany(Testimonial::class);
    }
}
