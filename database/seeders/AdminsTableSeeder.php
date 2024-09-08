<?php

namespace Database\Seeders;

use App\Models\admins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        admins::create([
            'name' => 'MohamedGaber' ,
            'email' => 'mohamedthebraveheart@gmail.com',
            'password'=> Hash::make('12345678') ,
            'super_admin' => 1 ,
            'status' => 'active',
        ]);
    }
}
