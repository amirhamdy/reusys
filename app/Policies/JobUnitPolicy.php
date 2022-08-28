<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobUnitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobUnit can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list jobunits');
    }

    /**
     * Determine whether the jobUnit can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobUnit  $model
     * @return mixed
     */
    public function view(User $user, JobUnit $model)
    {
        return $user->hasPermissionTo('view jobunits');
    }

    /**
     * Determine whether the jobUnit can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create jobunits');
    }

    /**
     * Determine whether the jobUnit can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobUnit  $model
     * @return mixed
     */
    public function update(User $user, JobUnit $model)
    {
        return $user->hasPermissionTo('update jobunits');
    }

    /**
     * Determine whether the jobUnit can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobUnit  $model
     * @return mixed
     */
    public function delete(User $user, JobUnit $model)
    {
        return $user->hasPermissionTo('delete jobunits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobUnit  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete jobunits');
    }

    /**
     * Determine whether the jobUnit can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobUnit  $model
     * @return mixed
     */
    public function restore(User $user, JobUnit $model)
    {
        return false;
    }

    /**
     * Determine whether the jobUnit can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobUnit  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobUnit $model)
    {
        return false;
    }
}
