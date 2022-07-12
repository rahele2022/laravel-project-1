<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{


    use HandlesAuthorization;

    public function show(User $user, Role $role)

    {
        return $user->role_id === $role->id;
    }

    public function edit(User $user)
    {
        return $user->role_id === Role::TYPE_ADMIN || $user->role_id === Role::TYPE_USER || Role::TYPE_ACCOUNT;
    }

    public function create(User $user)
    {

        return $user->role_id === Role::TYPE_ADMIN || $user->role_id === Role::TYPE_ACCOUNT;
    }


    public function destroy(User $user)
    {
        return $user->role_id == Role::TYPE_ADMIN;
    }


}
