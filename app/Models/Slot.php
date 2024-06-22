<?php

namespace App\Models;

use App\Casts\TimeCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $table = 'slots';

    protected $primaryKey = 'slot_id';

    protected $fillable = [
        'schedule_id',
        'stage_id',
        'lecture_id',
        'day',
        'start_time',
        'end_time',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'day' => 'date',
        'start_time' => TimeCast::class,
        'end_time' => TimeCast::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stage()
    {
        return $this->hasOne(Stage::class, 'stage_id', 'stage_id');
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'schedule_id', 'schedule_id');
    }

    public function lecture()
    {
        return $this->hasOne(Lecture::class, 'lecture_id', 'lecture_id');
    }
}
