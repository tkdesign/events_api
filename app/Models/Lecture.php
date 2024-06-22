<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $table = 'lectures';

    protected $primaryKey = 'lecture_id';

    protected $fillable = [
        'title',
        'short_desc',
        'desc',
        'image',
        'capacity',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function lectureHasUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureHasUser::class, 'lecture_id', 'lecture_id');
    }

    public function user(int $userId): ?User
    {
        return $this->users()->where('user_id', $userId)->first();
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'lectures_has_users', 'lecture_id', 'user_id');
    }

    public function slot(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Slot::class, 'lecture_id', 'lecture_id');
    }
}
