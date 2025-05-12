<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Http\Services\RoleService;
use App\Http\Services\UserService;
use App\Http\Services\ServiceService;
use App\Http\Services\PermissionService;
use App\Http\Services\NatureService;
use App\Http\Services\EtatService;
use App\Http\Services\IndemniteKilometriqueService;


class DatabaseSeeder extends Seeder
{

    private RoleService $roleService;
    private UserService $userService;
    private ServiceService $serviceService;
    private PermissionService $permissionService;
    private NatureService $natureService;
    private EtatService $etatService;

    public function __construct()
    {
        $this->roleService = new RoleService();
        $this->userService = new UserService();
        $this->serviceService = new ServiceService();
        $this->permissionService = new PermissionService();
        $this->natureService = new NatureService();
        $this->etatService = new EtatService();
    }

    protected function roleService() : RoleService
    {
        return $this->roleService;
    }

    protected function userService() : UserService
    {
        return $this->userService;
    }

    protected function serviceService() : ServiceService
    {
        return $this->serviceService;
    }

    protected function permissionService() : PermissionService
    {
        return $this->permissionService;
    }

    protected function natureService() : NatureService
    {
        return $this->natureService;
    }

    protected function etatService() : EtatService
    {
        return $this->etatService;
    }

    public function run()
    {
        $this->call([
            ServiceSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            NatureSeeder::class,
            EtatSeeder::class,
            IndemniteKilometriqueSeeder::class
        ]);
    }
}
 