<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class admins extends User
{
    use HasFactory;
    protected $table = 'admins';

    protected $fillable =
        ['name'  ,
        'email'  , 'password',
        'super_admin' , 'status'
        , 'remember_token' ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



}
