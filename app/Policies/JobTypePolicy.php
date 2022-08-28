<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobType;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list jobtypes');
    }

    /**
     * Determine whether the jobType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobType  $model
     * @return mixed
     */
    public function view(User $user, JobType $model)
    {
        return $user->hasPermissionTo('view jobtypes');
    }

    /**
     * Determine whether the jobType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create jobtypes');
    }

    /**
     * Determine whether the jobType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobType  $model
     * @return mixed
     */
    public function update(User $user, JobType $model)
    {
        return $user->hasPermissionTo('update jobtypes');
    }

    /**
     * Determine whether the jobType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobType  $model
     * @return mixed
     */
    public function delete(User $user, JobType $model)
    {
        return $user->hasPermissionTo('delete jobtypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete jobtypes');
    }

    /**
     * Determine whether the jobType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobType  $model
     * @return mixed
     */
    public function restore(User $user, JobType $model)
    {
        return false;
    }

    /**
     * Determine whether the jobType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\JobType  $model
     * @return mixed
     */
    public function forceDelete(User $user, JobType $model)
    {
        return false;
    }
}
