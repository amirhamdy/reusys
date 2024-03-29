<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the currency can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list currencies');
    }

    /**
     * Determine whether the currency can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Currency  $model
     * @return mixed
     */
    public function view(User $user, Currency $model)
    {
        return $user->hasPermissionTo('view currencies');
    }

    /**
     * Determine whether the currency can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create currencies');
    }

    /**
     * Determine whether the currency can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Currency  $model
     * @return mixed
     */
    public function update(User $user, Currency $model)
    {
        return $user->hasPermissionTo('update currencies');
    }

    /**
     * Determine whether the currency can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Currency  $model
     * @return mixed
     */
    public function delete(User $user, Currency $model)
    {
        return $user->hasPermissionTo('delete currencies');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Currency  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete currencies');
    }

    /**
     * Determine whether the currency can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Currency  $model
     * @return mixed
     */
    public function restore(User $user, Currency $model)
    {
        return false;
    }

    /**
     * Determine whether the currency can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Currency  $model
     * @return mixed
     */
    public function forceDelete(User $user, Currency $model)
    {
        return false;
    }
}
