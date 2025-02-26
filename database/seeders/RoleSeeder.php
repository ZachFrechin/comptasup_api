<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;


class RoleSeeder extends DatabaseSeeder
{
    public function run()
    {
        $employee = $this->roleService()->create('Employé');
        $valideur = $this->roleService()->create('Valideur');
        $controlleur = $this->roleService()->create('Contrôleur');
        $gestionnaire = $this->roleService()->create('Gestionnaire');
        $administrateur = $this->roleService()->create('Administrateur');

        $this->roleService()->addPermission($valideur, ['select_users']);
        $this->roleService()->addPermission($controlleur, ['select_users']);
        $this->roleService()->addPermission($gestionnaire, ['select_users', 'select_roles']);
        $this->roleService()->addPermission($administrateur, ['administrator']);

    }
}
