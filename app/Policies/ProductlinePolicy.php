<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Productline;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductlinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productline can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list productlines');
    }

    /**
     * Determine whether the productline can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Productline  $model
     * @return mixed
     */
    public function view(User $user, Productline $model)
    {
        return $user->hasPermissionTo('view productlines');
    }

    /**
     * Determine whether the productline can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create productlines');
    }

    /**
     * Determine whether the productline can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Productline  $model
     * @return mixed
     */
    public function update(User $user, Productline $model)
    {
        return $user->hasPermissionTo('update productlines');
    }

    /**
     * Determine whether the productline can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Productline  $model
     * @return mixed
     */
    public function delete(User $user, Productline $model)
    {
        return $user->hasPermissionTo('delete productlines');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Productline  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete productlines');
    }

    /**
     * Determine whether the productline can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Productline  $model
     * @return mixed
     */
    public function restore(User $user, Productline $model)
    {
        return false;
    }

    /**
     * Determine whether the productline can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Productline  $model
     * @return mixed
     */
    public function forceDelete(User $user, Productline $model)
    {
        return false;
    }
}
