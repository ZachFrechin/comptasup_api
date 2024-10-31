<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'email' => 'example@example.com',
            'password' => Hash::make('password'),
        ]);

        $roleFake = Role::create([
            "nom" => "Fake"
        ]);

        $user->roles()->attach($roleFake);
    }
}
