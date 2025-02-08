<?php

namespace Database\Seeders;

use App\Models\Profil;
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
        $admin = $this->createAdmin();
        $admin->roles()->attach(5);
        $admin->roles()->attach(1);

        $valideur = $this->createValideur();
        $valideur->roles()->attach(2);
        $valideur->roles()->attach(1);

        $controleur = $this->createControleur();
        $controleur->roles()->attach(3);
        $controleur->roles()->attach(1);

        $gestionnaire = $this->createGestionnaire();
        $gestionnaire->roles()->attach(4);
        $gestionnaire->roles()->attach(1);
    }

    public function createAdmin() : User {
        $user = User::factory()->create([
            'email' => 'administrateur@exemple.com',
            'password' => Hash::make('password'),
        ]);

        Profil::create([
            'nom' => 'Trépanier',
            'prenom' => 'Alexis',
            'naissance' => '1958-02-12',
            'telephone' => '0612345678',
            'code_postal' => '73000',
            'ville' => 'Chambéry',
            'pays' => 'France',
            'rue' => 'Rue des Elephants',
            'numero_de_rue' => 1,
            'user_id' => $user->id,
            'service_id'=> 1,
        ]);

        return $user;
    }

    public function createValideur() : User {
        $user = User::factory()->create([
            'email' => 'valideur@exemple.com',
            'password' => Hash::make('password'),
        ]);

        Profil::create([
            'nom' => 'Boulé',
            'prenom' => 'Matthieu',
            'naissance' => '1991-05-22',
            'telephone' => '0612345678',
            'code_postal' => '73000',
            'ville' => 'Chambéry',
            'pays' => 'France',
            'rue' => 'Rue des Arbres',
            'numero_de_rue' => 1,
            'user_id' => $user->id,
            'service_id'=> 1,
        ]);

        return $user;
    }

    public function createGestionnaire() : User {
        $user = User::factory()->create([
            'email' => 'gestionnaire@exemple.com',
            'password' => Hash::make('password'),
        ]);

        Profil::create([
            'nom' => 'Bussière',
            'prenom' => 'Georges',
            'naissance' => '1993-11-29',
            'telephone' => '0612345678',
            'code_postal' => '73000',
            'ville' => 'Chambéry',
            'pays' => 'France',
            'rue' => 'Rue des Champignons',
            'numero_de_rue' => 1,
            'user_id' => $user->id,
            'service_id'=> 1,
        ]);

        return $user;
    }

    public function createControleur() : User {
        $user = User::factory()->create([
            'email' => 'controleur@exemple.com',
            'password' => Hash::make('password'),
        ]);

        Profil::create([
            'nom' => 'Archaimbau',
            'prenom' => 'Grégoire',
            'naissance' => '2001-04-04',
            'telephone' => '0612345678',
            'code_postal' => '73000',
            'ville' => 'Chambéry',
            'pays' => 'France',
            'rue' => 'Rue des Poissons',
            'numero_de_rue' => 1,
            'user_id' => $user->id,
            'service_id'=> 1,
        ]);

        return $user;
    }
}
