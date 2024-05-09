<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lections_has_speakers extends Model
{
    use HasFactory;

    public function lection()
    {
        return $this->belongsTo(Lection::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }
}
