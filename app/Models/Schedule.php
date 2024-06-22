<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'schedule_id',
        'title',
        'event_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stages() {
        return $this->hasMany(Stage::class, 'schedule_id', 'schedule_id');
    }

    public function event() {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }
}
