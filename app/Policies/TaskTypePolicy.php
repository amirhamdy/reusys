<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TaskType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the taskType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list tasktypes');
    }

    /**
     * Determine whether the taskType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskType  $model
     * @return mixed
     */
    public function view(User $user, TaskType $model)
    {
        return $user->hasPermissionTo('view tasktypes');
    }

    /**
     * Determine whether the taskType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create tasktypes');
    }

    /**
     * Determine whether the taskType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskType  $model
     * @return mixed
     */
    public function update(User $user, TaskType $model)
    {
        return $user->hasPermissionTo('update tasktypes');
    }

    /**
     * Determine whether the taskType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskType  $model
     * @return mixed
     */
    public function delete(User $user, TaskType $model)
    {
        return $user->hasPermissionTo('delete tasktypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete tasktypes');
    }

    /**
     * Determine whether the taskType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskType  $model
     * @return mixed
     */
    public function restore(User $user, TaskType $model)
    {
        return false;
    }

    /**
     * Determine whether the taskType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskType  $model
     * @return mixed
     */
    public function forceDelete(User $user, TaskType $model)
    {
        return false;
    }
}
