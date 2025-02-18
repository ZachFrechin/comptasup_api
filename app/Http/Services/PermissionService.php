<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Permission;

class PermissionService extends Service
{
    public function create(string $name) : Permission
    {
        return Permission::create(["nom" => $name]);
    }

    public function getByName(string $name) : Permission | null
    {
        return Permission::where(['nom' => $name])->first();
    }
}
