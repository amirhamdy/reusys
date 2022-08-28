<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Industry;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndustryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the industry can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list industries');
    }

    /**
     * Determine whether the industry can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function view(User $user, Industry $model)
    {
        return $user->hasPermissionTo('view industries');
    }

    /**
     * Determine whether the industry can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create industries');
    }

    /**
     * Determine whether the industry can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function update(User $user, Industry $model)
    {
        return $user->hasPermissionTo('update industries');
    }

    /**
     * Determine whether the industry can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function delete(User $user, Industry $model)
    {
        return $user->hasPermissionTo('delete industries');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete industries');
    }

    /**
     * Determine whether the industry can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function restore(User $user, Industry $model)
    {
        return false;
    }

    /**
     * Determine whether the industry can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Industry  $model
     * @return mixed
     */
    public function forceDelete(User $user, Industry $model)
    {
        return false;
    }
}
