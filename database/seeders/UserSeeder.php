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
            'photo_profile' => 'photoProfile/atmin.png',
            'name' => 'admin',
            'address' => '.....',
            'phone_number' => '123123123',
            'email' => 'admin@gmail.com',
            'password' => '12345678',
        ])->assignRole('admin');

        User::create([
            'photo_profile' => 'photoProfile/member.jpg',
            'name' => 'member',
            'address' => '.....',
            'phone_number' => '123456789',
            'email' => 'member@gmail.com',
            'password' => '12345678',
        ])->assignRole('member');
    }
}
