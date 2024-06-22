<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleHasStage extends Model
{
    use HasFactory;

    protected $table = 'schedules_has_stages';

    protected $fillable = [
        'schedule_id',
        'stage_id',
        'visible',
        'position',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stage() {
        return $this->hasOne(Stage::class, 'stage_id', 'stage_id');
    }

    public function schedule() {
        return $this->hasOne(Schedule::class, 'schedule_id', 'schedule_id');
    }
}
