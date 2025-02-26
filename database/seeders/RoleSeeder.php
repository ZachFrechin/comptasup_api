<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;


class RoleSeeder extends DatabaseSeeder
{
    public function run()
    {
        $employee = $this->roleService()->create('Salarié');
        $valideur = $this->roleService()->create('Valideur');
        $controlleur = $this->roleService()->create('Contrôleur');
        $gestionnaire = $this->roleService()->create('Gestionnaire');
        $administrateur = $this->roleService()->create('Administrateur');

        $this->roleService()->addPermission($valideur, ['select_users', 'validate_notes']);
        $this->roleService()->addPermission($controlleur, ['select_users', 'control_notes']);
        $this->roleService()->addPermission($gestionnaire, ['select_users', 'select_roles']);
        $this->roleService()->addPermission($administrateur, ['administrator']);

    }
}
