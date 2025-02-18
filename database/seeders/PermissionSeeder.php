<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends DatabaseSeeder
{
    public function run()
    {
        $this->permissionService()->create('select_roles');
        $this->permissionService()->create('create_roles');
        $this->permissionService()->create('update_roles');
        $this->permissionService()->create('delete_roles');
        $this->permissionService()->create('manage_roles');
        $this->permissionService()->create('select_users');
        $this->permissionService()->create('create_users');
        $this->permissionService()->create('update_users');
        $this->permissionService()->create('delete_users');
        $this->permissionService()->create('manage_users');
        $this->permissionService()->create('administrator');
    }
}