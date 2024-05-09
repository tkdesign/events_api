<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function lection()
    {
        return $this->belongsTo(Lection::class);
    }
}
