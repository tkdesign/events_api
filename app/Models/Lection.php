<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lection extends Model
{
    use HasFactory;

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function lections_has_users()
    {
        return $this->hasMany(Lections_has_users::class);
    }

    public function lections_has_speakers()
    {
        return $this->hasMany(Lections_has_speakers::class);
    }
}
