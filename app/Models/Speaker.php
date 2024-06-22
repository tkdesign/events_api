<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $table = 'speakers';

    protected $primaryKey = 'speaker_id';

    protected $fillable = [
        'titul',
        'first_name',
        'last_name',
        'company',
        'occupation',
        'short_desc',
        'desc',
        'email',
        'phone',
        'facebook',
        'instagram',
        'linkedin',
        'image',
        'thumbnail',
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
