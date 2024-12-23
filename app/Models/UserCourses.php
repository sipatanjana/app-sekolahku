<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCourses extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_course',
    ];

    public function CountUser()
    {
        return self::where('id_course', $this->id_course)->count();
    }

    public function CountFee(): BelongsTo
    {
        return self::where('id_course', $this->id_course)->count();
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function Courses(): BelongsTo
    {
        return $this->belongsTo(Courses::class, 'id_course');
    }
}
