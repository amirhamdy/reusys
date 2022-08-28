<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TaskUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskUnitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the taskUnit can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list taskunits');
    }

    /**
     * Determine whether the taskUnit can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskUnit  $model
     * @return mixed
     */
    public function view(User $user, TaskUnit $model)
    {
        return $user->hasPermissionTo('view taskunits');
    }

    /**
     * Determine whether the taskUnit can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create taskunits');
    }

    /**
     * Determine whether the taskUnit can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskUnit  $model
     * @return mixed
     */
    public function update(User $user, TaskUnit $model)
    {
        return $user->hasPermissionTo('update taskunits');
    }

    /**
     * Determine whether the taskUnit can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskUnit  $model
     * @return mixed
     */
    public function delete(User $user, TaskUnit $model)
    {
        return $user->hasPermissionTo('delete taskunits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskUnit  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete taskunits');
    }

    /**
     * Determine whether the taskUnit can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskUnit  $model
     * @return mixed
     */
    public function restore(User $user, TaskUnit $model)
    {
        return false;
    }

    /**
     * Determine whether the taskUnit can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TaskUnit  $model
     * @return mixed
     */
    public function forceDelete(User $user, TaskUnit $model)
    {
        return false;
    }
}
