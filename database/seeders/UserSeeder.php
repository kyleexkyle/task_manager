<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kyle Castillon',
            'email' => 'kyle@test.com',
            'password' => Hash::make(12345678),
        ]);

        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => Hash::make(12345678),
        ]);
    }
}
