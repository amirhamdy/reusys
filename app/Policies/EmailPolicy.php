<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Email;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the email can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list emails');
    }

    /**
     * Determine whether the email can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Email  $model
     * @return mixed
     */
    public function view(User $user, Email $model)
    {
        return $user->hasPermissionTo('view emails');
    }

    /**
     * Determine whether the email can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create emails');
    }

    /**
     * Determine whether the email can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Email  $model
     * @return mixed
     */
    public function update(User $user, Email $model)
    {
        return $user->hasPermissionTo('update emails');
    }

    /**
     * Determine whether the email can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Email  $model
     * @return mixed
     */
    public function delete(User $user, Email $model)
    {
        return $user->hasPermissionTo('delete emails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Email  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete emails');
    }

    /**
     * Determine whether the email can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Email  $model
     * @return mixed
     */
    public function restore(User $user, Email $model)
    {
        return false;
    }

    /**
     * Determine whether the email can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Email  $model
     * @return mixed
     */
    public function forceDelete(User $user, Email $model)
    {
        return false;
    }
}
