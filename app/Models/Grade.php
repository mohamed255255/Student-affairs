<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'course_work',
        'final_work',
        'grade',
    ];
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->belongsTo(course::class);
    }

}
