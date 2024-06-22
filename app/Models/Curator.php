<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curator extends Model
{
    use HasFactory;

    protected $table = 'curators';

    protected $primaryKey = 'curator_id';

    protected $fillable = [
        'titul',
        'first_name',
        'last_name',
        'company',
        'occupation',
        'phone',
        'email',
        'photo_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
