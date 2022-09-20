<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Opportunity;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpportunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the opportunity can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list opportunities');
    }

    /**
     * Determine whether the opportunity can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportunity  $model
     * @return mixed
     */
    public function view(User $user, Opportunity $model)
    {
        return $user->hasPermissionTo('view opportunities');
    }

    /**
     * Determine whether the opportunity can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create opportunities');
    }

    /**
     * Determine whether the opportunity can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportunity  $model
     * @return mixed
     */
    public function update(User $user, Opportunity $model)
    {
        return $user->hasPermissionTo('update opportunities');
    }

    /**
     * Determine whether the opportunity can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportunity  $model
     * @return mixed
     */
    public function delete(User $user, Opportunity $model)
    {
        return $user->hasPermissionTo('delete opportunities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportunity  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete opportunities');
    }

    /**
     * Determine whether the opportunity can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportunity  $model
     * @return mixed
     */
    public function restore(User $user, Opportunity $model)
    {
        return false;
    }

    /**
     * Determine whether the opportunity can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Opportunity  $model
     * @return mixed
     */
    public function forceDelete(User $user, Opportunity $model)
    {
        return false;
    }
}
