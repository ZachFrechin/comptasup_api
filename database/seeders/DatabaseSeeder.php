<?php

namespace Database\Seeders;

use App\Models\Profil;
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

        Profil::create([
            'nom' => 'nomExample',
            'prenom' => 'prenomExample',
            'naissance' => '1980-01-01',
            'code_postal' => '73000',
            'ville' => 'Chambéry',
            'pays' => 'France',
            'rue' => 'rue Sommeiller',
            'numero_de_rue' => 1,
            'user_id' => $user->id,
        ]);

        $adminRole = Role::create([
            "nom" => "Administrateur"
        ]);

        $user->roles()->attach($adminRole);
    }
}
