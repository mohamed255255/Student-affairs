<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'CourseName' ,
        'DoctorName' ,
        'description',
        'pre-requisites',
        'max_students'
    ];
    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }
}
