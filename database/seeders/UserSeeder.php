<?php

namespace Database\Seeders;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends DatabaseSeeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = $this->createAdmin();
        $this->userService()->addRoles($admin, ['Administrateur']);

        $gestionnaire = $this->createGestionnaire();
        $this->userService()->addRoles($gestionnaire, ['Gestionnaire']);

        $controleur = $this->createControleur();
        $this->userService()->addRoles($controleur, ['Contrôleur']);

        $valideur = $this->createValideur();
        $this->userService()->addRoles($valideur, ['Valideur']);
    }

    public function createAdmin() : User
    {
        $user = $this->userService()->create(
            'administrateur@exemple.com',
            'password',
            [
                'nom' => 'Trépanier',
                'prenom' => 'Alexis',
                'naissance' => '1958-02-12',
                'telephone' => '0612345678',
                'code_postal' => '73000',
                'ville' => 'Chambéry',
                'pays' => 'France',
                'rue' => 'Rue des Elephants',
                'numero_de_rue' => 1,
                'service_id'=> $this->serviceService()->getByName('Administratif')->id,
            ]);

        return $user;
    }

    public function createGestionnaire() : User
    {
        $user = $this->userService()->create(
            'gestionnaire@exemple.com',
            'password',
            [
                'nom' => 'Bussière',
                'prenom' => 'Georges',
                'naissance' => '1993-11-29',
                'telephone' => '0612345678',
                'code_postal' => '73000',
                'ville' => 'Chambéry',
                'pays' => 'France',
                'rue' => 'Rue des Champignons',
                'numero_de_rue' => 1,
                'service_id'=> $this->serviceService()->getByName('Direction')->id,
            ]);

        return $user;
    }

    public function createControleur() : User
    {
        $user = $this->userService()->create(
            'controleur@exemple.com',
            'password',
            [
                'nom' => 'Archaimbau',
                'prenom' => 'Grégoire',
                'naissance' => '2001-04-04',
                'telephone' => '0612345678',
                'code_postal' => '73000',
                'ville' => 'Chambéry',
                'pays' => 'France',
                'rue' => 'Rue des Poissons',
                'numero_de_rue' => 1,
                'service_id'=> $this->serviceService()->getByName('Coordination')->id,
            ]);

        return $user;
    }

    public function createValideur() : User
    {
        $user = $this->userService()->create(
            'valideur@exemple.com',
            'password',
            [
                'nom' => 'Boulé',
                'prenom' => 'Matthieu',
                'naissance' => '1991-05-22',
                'telephone' => '0612345678',
                'code_postal' => '73000',
                'ville' => 'Chambéry',
                'pays' => 'France',
                'rue' => 'Rue des Arbres',
                'numero_de_rue' => 1,
                'service_id'=> $this->serviceService()->getByName('Coordination')->id,
            ]);

        return $user;
    }
}
