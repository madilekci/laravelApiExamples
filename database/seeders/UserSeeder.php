<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    public function run()
    {
        User::factory()->count(3)->create();

        \DB::table('users')->insert([
           'name' => 'admin',
           'user_type' => 'admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make('password'),
       ]);
    }
}
