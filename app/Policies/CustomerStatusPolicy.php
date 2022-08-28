<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CustomerStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customerStatus can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list customerstatuses');
    }

    /**
     * Determine whether the customerStatus can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerStatus  $model
     * @return mixed
     */
    public function view(User $user, CustomerStatus $model)
    {
        return $user->hasPermissionTo('view customerstatuses');
    }

    /**
     * Determine whether the customerStatus can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create customerstatuses');
    }

    /**
     * Determine whether the customerStatus can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerStatus  $model
     * @return mixed
     */
    public function update(User $user, CustomerStatus $model)
    {
        return $user->hasPermissionTo('update customerstatuses');
    }

    /**
     * Determine whether the customerStatus can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerStatus  $model
     * @return mixed
     */
    public function delete(User $user, CustomerStatus $model)
    {
        return $user->hasPermissionTo('delete customerstatuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerStatus  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete customerstatuses');
    }

    /**
     * Determine whether the customerStatus can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerStatus  $model
     * @return mixed
     */
    public function restore(User $user, CustomerStatus $model)
    {
        return false;
    }

    /**
     * Determine whether the customerStatus can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerStatus  $model
     * @return mixed
     */
    public function forceDelete(User $user, CustomerStatus $model)
    {
        return false;
    }
}
