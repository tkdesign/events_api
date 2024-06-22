<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventHasCurator extends Model
{
    use HasFactory;

    protected $table = 'events_has_curators';

    protected $primaryKey = 'id';

    protected $fillable = [
        'event_id',
        'curator_id',
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

    public function event()
    {
        return $this->hasOne(Event::class, 'event_id', 'event_id');
    }

    public function curator()
    {
        return $this->hasOne(Curator::class, 'curator_id', 'curator_id');
    }
}
