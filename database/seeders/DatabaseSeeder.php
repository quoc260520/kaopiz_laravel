<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $admimDefaul = User::where('email','admin@gmail.com')->first();
        if(!$admimDefaul){
            User::insert([
                'email' => 'admin@gmail.com',
                'password' => Hash::make(12345678),
                'role' => 1,
            ]);
        }
        \App\Models\UserOrm::factory(20)->create();
    }
}
