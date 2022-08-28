<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pricebook;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricebookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pricebook can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list pricebooks');
    }

    /**
     * Determine whether the pricebook can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricebook  $model
     * @return mixed
     */
    public function view(User $user, Pricebook $model)
    {
        return $user->hasPermissionTo('view pricebooks');
    }

    /**
     * Determine whether the pricebook can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create pricebooks');
    }

    /**
     * Determine whether the pricebook can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricebook  $model
     * @return mixed
     */
    public function update(User $user, Pricebook $model)
    {
        return $user->hasPermissionTo('update pricebooks');
    }

    /**
     * Determine whether the pricebook can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricebook  $model
     * @return mixed
     */
    public function delete(User $user, Pricebook $model)
    {
        return $user->hasPermissionTo('delete pricebooks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricebook  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete pricebooks');
    }

    /**
     * Determine whether the pricebook can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricebook  $model
     * @return mixed
     */
    public function restore(User $user, Pricebook $model)
    {
        return false;
    }

    /**
     * Determine whether the pricebook can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Pricebook  $model
     * @return mixed
     */
    public function forceDelete(User $user, Pricebook $model)
    {
        return false;
    }
}
