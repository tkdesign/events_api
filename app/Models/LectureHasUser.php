<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureHasUser extends Model
{
    use HasFactory;

    protected $table = 'lectures_has_users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'lecture_id',
        'user_id',
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

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'lecture_id', 'lecture_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
