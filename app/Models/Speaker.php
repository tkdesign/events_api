<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    public function lections_has_speakers()
    {
        return $this->hasMany(Lections_has_speakers::class);
    }
}
