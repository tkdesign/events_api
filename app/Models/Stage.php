<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $table = 'stages';

    protected $primaryKey = 'stage_id';

    protected $fillable = [
        'title',
        'location',
        'max_capacity'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function slots($schedule_id)
    {
        return $this->hasMany(Slot::class, 'stage_id', 'stage_id')->where('schedule_id', $schedule_id);
    }
}
