<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Portal;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the portal can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list portals');
    }

    /**
     * Determine whether the portal can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Portal  $model
     * @return mixed
     */
    public function view(User $user, Portal $model)
    {
        return $user->hasPermissionTo('view portals');
    }

    /**
     * Determine whether the portal can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create portals');
    }

    /**
     * Determine whether the portal can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Portal  $model
     * @return mixed
     */
    public function update(User $user, Portal $model)
    {
        return $user->hasPermissionTo('update portals');
    }

    /**
     * Determine whether the portal can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Portal  $model
     * @return mixed
     */
    public function delete(User $user, Portal $model)
    {
        return $user->hasPermissionTo('delete portals');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Portal  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete portals');
    }

    /**
     * Determine whether the portal can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Portal  $model
     * @return mixed
     */
    public function restore(User $user, Portal $model)
    {
        return false;
    }

    /**
     * Determine whether the portal can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Portal  $model
     * @return mixed
     */
    public function forceDelete(User $user, Portal $model)
    {
        return false;
    }
}
