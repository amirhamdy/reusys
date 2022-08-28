<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pricelist;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricelistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pricelist can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list pricelists');
    }

    /**
     * Determine whether the pricelist can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricelist  $model
     * @return mixed
     */
    public function view(User $user, Pricelist $model)
    {
        return $user->hasPermissionTo('view pricelists');
    }

    /**
     * Determine whether the pricelist can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create pricelists');
    }

    /**
     * Determine whether the pricelist can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricelist  $model
     * @return mixed
     */
    public function update(User $user, Pricelist $model)
    {
        return $user->hasPermissionTo('update pricelists');
    }

    /**
     * Determine whether the pricelist can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricelist  $model
     * @return mixed
     */
    public function delete(User $user, Pricelist $model)
    {
        return $user->hasPermissionTo('delete pricelists');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricelist  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete pricelists');
    }

    /**
     * Determine whether the pricelist can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricelist  $model
     * @return mixed
     */
    public function restore(User $user, Pricelist $model)
    {
        return false;
    }

    /**
     * Determine whether the pricelist can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricelist  $model
     * @return mixed
     */
    public function forceDelete(User $user, Pricelist $model)
    {
        return false;
    }
}
