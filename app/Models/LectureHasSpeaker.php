<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureHasSpeaker extends Model
{
    use HasFactory;

    protected $table = 'lectures_has_speakers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lecture_id',
        'speaker_id',
        'visible',
        'position',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
//        'visible' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lecture()
    {
        return $this->hasOne(Lecture::class, 'lecture_id', 'lecture_id');
    }

    public function speaker()
    {
        return $this->hasOne(Speaker::class, 'speaker_id', 'speaker_id');
    }
}
