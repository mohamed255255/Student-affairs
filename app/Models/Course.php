<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    protected $fillable = [
        'CourseName' ,
        'DoctorName' ,
        'description',
        'pre-requisites',
        'max_students'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }


    public function grades(){
        return $this->hasMany(grade::class)->withTimestamps();
    }
}
