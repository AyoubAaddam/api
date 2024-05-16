<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::insert([
            'name'=>'Ayoub',
            'email'=>'ayoub@gmail.com',
            'password'=>Hash::make('ayoub123')
        ]);
    }
}
