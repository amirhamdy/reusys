<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Opportuninty;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpportunintyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the opportuninty can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list opportuninties');
    }

    /**
     * Determine whether the opportuninty can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportuninty  $model
     * @return mixed
     */
    public function view(User $user, Opportuninty $model)
    {
        return $user->hasPermissionTo('view opportuninties');
    }

    /**
     * Determine whether the opportuninty can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create opportuninties');
    }

    /**
     * Determine whether the opportuninty can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportuninty  $model
     * @return mixed
     */
    public function update(User $user, Opportuninty $model)
    {
        return $user->hasPermissionTo('update opportuninties');
    }

    /**
     * Determine whether the opportuninty can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportuninty  $model
     * @return mixed
     */
    public function delete(User $user, Opportuninty $model)
    {
        return $user->hasPermissionTo('delete opportuninties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportuninty  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete opportuninties');
    }

    /**
     * Determine whether the opportuninty can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportuninty  $model
     * @return mixed
     */
    public function restore(User $user, Opportuninty $model)
    {
        return false;
    }

    /**
     * Determine whether the opportuninty can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportuninty  $model
     * @return mixed
     */
    public function forceDelete(User $user, Opportuninty $model)
    {
        return false;
    }
}
