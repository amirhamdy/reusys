<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Phone;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the phone can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list phones');
    }

    /**
     * Determine whether the phone can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Phone  $model
     * @return mixed
     */
    public function view(User $user, Phone $model)
    {
        return $user->hasPermissionTo('view phones');
    }

    /**
     * Determine whether the phone can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create phones');
    }

    /**
     * Determine whether the phone can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Phone  $model
     * @return mixed
     */
    public function update(User $user, Phone $model)
    {
        return $user->hasPermissionTo('update phones');
    }

    /**
     * Determine whether the phone can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Phone  $model
     * @return mixed
     */
    public function delete(User $user, Phone $model)
    {
        return $user->hasPermissionTo('delete phones');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Phone  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete phones');
    }

    /**
     * Determine whether the phone can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Phone  $model
     * @return mixed
     */
    public function restore(User $user, Phone $model)
    {
        return false;
    }

    /**
     * Determine whether the phone can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Phone  $model
     * @return mixed
     */
    public function forceDelete(User $user, Phone $model)
    {
        return false;
    }
}
