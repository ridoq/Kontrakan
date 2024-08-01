<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'photo_profile' => null,
            'name' => 'admin',
            'address' => '.....',
            'phone_number' => '123123123',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '12345678',
            'pw'=>'12345678'
            ])->assignRole('admin');

        User::create([
            'photo_profile' => null,
            'name' => 'member',
            'address' => '.....',
            'phone_number' => '123456789',
            'email' => 'member@gmail.com',
            // 'email_verified_at' => now(),
            'password' => '12345678',
            'pw'=>'pw_lama'
            ])->assignRole('member');
    }
}
