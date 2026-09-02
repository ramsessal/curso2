<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@blog.test',
            'password' => Hash::make('secreto123'),
            'rol' => 'admin',
        ]);

        User::create([
            'name' => 'Editor de guardia',
            'email' => 'editor@blog.test',
            'password' => Hash::make('secreto123'),
            'rol' => 'editor',
        ]);
    }
}
