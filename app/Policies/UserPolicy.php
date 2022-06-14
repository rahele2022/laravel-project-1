<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{


    use HandlesAuthorization;

    public function create(User $user , Role $role)
    {
        return ($user->role_id == 2 || $user->role_id == 3);
    }

    public function edit(User $user, User$currentUser)
    {
        return ($user->role_id == 1 ||  $user->role_id == 2 || $user->role_id == 3) ;
    }

    public function delete(User $user, User $currentUser)
    {
        return $user->role_id == 2;
    }



}
