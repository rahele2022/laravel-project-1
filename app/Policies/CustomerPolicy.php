<?php

namespace App\Policies;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function Composer\Autoload\includeFile;

class CustomerPolicy
{
    use HandlesAuthorization;

 public function edit(User $user , Customer $currentCustomer)
 {
     return ($user->id == 1 || $user->id == $currentCustomer->id);
 }
 public function delete(User $user , Customer $currentCustomer)
 {
     return $user->id == 1;
 }
}
