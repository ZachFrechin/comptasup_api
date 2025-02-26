<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Role;
use App\Http\Services\PermissionService;

class RoleService extends Service
{
    private PermissionService $permissionService;

    public function __construct()
    {
        $this->permissionService = new PermissionService();
    }

    private function permissionService() : PermissionService
    {
        return $this->permissionService;
    }

    public function create(string $name) : Role
    {
        return Role::create(['nom' => $name]);
    }

    public function getByName(string $name) : Role | null
    {
        return Role::where(['nom' => $name])->first();
    }

    public function createBaseRole() : void
    {
        $this->create('Employé');
        $this->create('Valideur');
        $this->create('Contrôleur');
        $this->create('Gestionnaire');
        $this->create('Administrateur');
    }

    private function arrayWalkPermissionsIDs(&$item, $key) : void
    {
        $item = $this->permissionService()->getByName($item)->id;
    }

    public function addPermission(Role $role, array $permissionsName) : Role
    {
        array_walk($permissionsName, [$this, 'arrayWalkPermissionsIDs']);
        $role->permissions()->attach($permissionsName);
        return $role;
    }
}
