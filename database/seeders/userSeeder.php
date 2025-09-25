<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nama' => 'azzafarmkoi',
            'email' => 'azzafarmkoi@gmail.com',
            'role' => 'Admin',
            'password' => Hash::make('azzafarmkoi'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
