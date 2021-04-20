<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3);

        DB::table('users')->insert([
           'name' => 'admin',
           'user_type' => 'admin',
           'email' => 'admin@admin.com',
           'password' => Hash::make('password'),
       ]);
    }
}
