<?php

namespace App\Http\Controllers;

use App\Traits\ServiceCallable;
use App\Http\Services\NoteService;
use App\Http\Services\NoteHistoryService;
use App\Http\Services\UserService;
use App\Http\Services\NatureService;
use App\Http\Services\EtatService;
use App\Http\Services\RoleService;
use App\Http\Services\PermissionService;
use App\Http\Services\ServiceService;
use App\Http\Services\DepenseService;
abstract class Controller
{
    use ServiceCallable;

    public function __construct()
    {
        $this->registerServices([
            'noteService' => NoteService::class,
            'noteHistoryService' => NoteHistoryService::class,
            'userService' => UserService::class,
            'natureService' => NatureService::class,
            'etatService' => EtatService::class,
            'roleService' => RoleService::class,
            'permissionService' => PermissionService::class,
            'serviceService' => ServiceService::class,
            'depenseService' => DepenseService::class,
        ]);
    }
}