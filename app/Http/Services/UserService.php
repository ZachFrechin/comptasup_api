<?php

namespace App\Http\Services;

use App\Models\NoteHistory;
use App\Http\Services\Service;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Profil;
use App\Http\Services\RoleService;

class UserService extends Service
{
    private RoleService $roleService;

    public function __construct()
    {
        $this->roleService = new RoleService();
    }

    private function roleService() : RoleService
    {
        return $this->roleService;
    }

    public function create(string $mail, string $password, array $profil) : User
    {
        $user = User::create(
            [
                'email' => $mail,
                'password' => Hash::make($password),
            ]);

        $profil = Profil::create($profil);
        $profil->update(['user_id' => $user->id]);
        $this->addRoles($user, ['Salarié']);
        return $user;
    }

    public function updateProfil(User $user, array $fields) : User
    {
        $user->profil()->update($fields);
        return $user;
    }

    public function updateMail(User $user, string $mail) : User
    {
        $user->update(['email' => $mail]);
        return $user;
    }

    public function getByID(int $id) : User | null
    {
        return User::find($id);
    }

    private function arrayWalkRoleID(&$item, $key) : void
    {
        $item = $this->roleService()->getByName($item)->id;
    }

    public function addRoles(User $user, array $roleName) : User
    {
        array_walk($roleName, [$this, 'arrayWalkRoleID']);
        $user->roles()->attach($roleName);
        return $user;
    }

    public function addRolesByID(User $user, array $roleID) : User
    {
        $user->roles()->attach($roleID);
        return $user;
    }

    public function updatePassword(User $user, string $old_password, string $password) : User
    {
        if (!Hash::check($old_password, $user->password)) {
            throw new \Exception('Current password is incorrect');
        }

        $user->update(['password' => Hash::make($password)]);
        return $user;
    }

    public function getAffiliatedUsers(User $user) : Collection
    {
        return $user->usersValides;
    }

    public function getAffiliatedUsersID(int $id) : Collection
    {
        return User::find($id)->usersValides->pluck('id');
    }

    public function addAffiliatedUsers(User $user, array $affiliatedUsers) : void
    {
        $user->usersValides()->attach($affiliatedUsers);
    }

    public function removeAffiliatedUser(User $user, array $affiliatedUsers) : void
    {
        $user->usersValides()->detach($affiliatedUsers);
    }
}

