<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin2.0@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'admin',
                'email' => 'admin2.0@gmail.com',
                'password' => Hash::make('admin@1234'),
                'role' => 1,
                'created_at' => now(),
            ]);
        }
        $user->update([
            'name' => 'super admin',
            'email' => 'admin2.0@gmail.com',
            'password' => Hash::make('admin@1234'),
            'role' => 1,
            'updated_at' => now(),
        ]);
    }
}
