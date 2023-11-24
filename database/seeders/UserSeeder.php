<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Camilo',
            'role_id' => '1',
            'email' => 'f.camilo.993.dev@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1qaZXsw2'), // 1qaZXsw2
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Admin Santo',
            'role_id' => '1',
            'email' => 'o.santo.uno@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1qaZXsw2'), // password
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Admin Fabiola',
            'role_id' => '1',
            'email' => 'fabiola@surmodel.cl',
            'email_verified_at' => now(),
            'password' => Hash::make('SurModel'), // password
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Admin Carolina',
            'role_id' => '1',
            'email' => 'carolina@surmodel.cl',
            'email_verified_at' => now(),
            'password' => Hash::make('SurModel'), // password
            'remember_token' => Str::random(10)
        ]);
    }
}
