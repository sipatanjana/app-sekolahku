<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courses extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'mentor',
        'title',
    ];
    
    public function UserCourses(): HasMany
    {
        return $this->hasMany(UserCourses::class, 'id_course');
    }
}
