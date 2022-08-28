<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CustomerRating;
use Illuminate\Auth\Access\HandlesAuthorization;

class CustomerRatingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the customerRating can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list customerratings');
    }

    /**
     * Determine whether the customerRating can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerRating  $model
     * @return mixed
     */
    public function view(User $user, CustomerRating $model)
    {
        return $user->hasPermissionTo('view customerratings');
    }

    /**
     * Determine whether the customerRating can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create customerratings');
    }

    /**
     * Determine whether the customerRating can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerRating  $model
     * @return mixed
     */
    public function update(User $user, CustomerRating $model)
    {
        return $user->hasPermissionTo('update customerratings');
    }

    /**
     * Determine whether the customerRating can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerRating  $model
     * @return mixed
     */
    public function delete(User $user, CustomerRating $model)
    {
        return $user->hasPermissionTo('delete customerratings');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerRating  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete customerratings');
    }

    /**
     * Determine whether the customerRating can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerRating  $model
     * @return mixed
     */
    public function restore(User $user, CustomerRating $model)
    {
        return false;
    }

    /**
     * Determine whether the customerRating can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\CustomerRating  $model
     * @return mixed
     */
    public function forceDelete(User $user, CustomerRating $model)
    {
        return false;
    }
}
