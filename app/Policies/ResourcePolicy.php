<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Resource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the resource can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list resources');
    }

    /**
     * Determine whether the resource can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Resource  $model
     * @return mixed
     */
    public function view(User $user, Resource $model)
    {
        return $user->hasPermissionTo('view resources');
    }

    /**
     * Determine whether the resource can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create resources');
    }

    /**
     * Determine whether the resource can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Resource  $model
     * @return mixed
     */
    public function update(User $user, Resource $model)
    {
        return $user->hasPermissionTo('update resources');
    }

    /**
     * Determine whether the resource can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Resource  $model
     * @return mixed
     */
    public function delete(User $user, Resource $model)
    {
        return $user->hasPermissionTo('delete resources');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Resource  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete resources');
    }

    /**
     * Determine whether the resource can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Resource  $model
     * @return mixed
     */
    public function restore(User $user, Resource $model)
    {
        return false;
    }

    /**
     * Determine whether the resource can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Resource  $model
     * @return mixed
     */
    public function forceDelete(User $user, Resource $model)
    {
        return false;
    }
}
