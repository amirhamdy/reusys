<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the taskStatus can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list taskstatuses');
    }

    /**
     * Determine whether the taskStatus can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskStatus  $model
     * @return mixed
     */
    public function view(User $user, TaskStatus $model)
    {
        return $user->hasPermissionTo('view taskstatuses');
    }

    /**
     * Determine whether the taskStatus can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create taskstatuses');
    }

    /**
     * Determine whether the taskStatus can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskStatus  $model
     * @return mixed
     */
    public function update(User $user, TaskStatus $model)
    {
        return $user->hasPermissionTo('update taskstatuses');
    }

    /**
     * Determine whether the taskStatus can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskStatus  $model
     * @return mixed
     */
    public function delete(User $user, TaskStatus $model)
    {
        return $user->hasPermissionTo('delete taskstatuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskStatus  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete taskstatuses');
    }

    /**
     * Determine whether the taskStatus can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskStatus  $model
     * @return mixed
     */
    public function restore(User $user, TaskStatus $model)
    {
        return false;
    }

    /**
     * Determine whether the taskStatus can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskStatus  $model
     * @return mixed
     */
    public function forceDelete(User $user, TaskStatus $model)
    {
        return false;
    }
}
