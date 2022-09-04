<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OpportunityUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpportunityUnitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the opportunityUnit can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list opportunityunits');
    }

    /**
     * Determine whether the opportunityUnit can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityUnit  $model
     * @return mixed
     */
    public function view(User $user, OpportunityUnit $model)
    {
        return $user->hasPermissionTo('view opportunityunits');
    }

    /**
     * Determine whether the opportunityUnit can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create opportunityunits');
    }

    /**
     * Determine whether the opportunityUnit can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityUnit  $model
     * @return mixed
     */
    public function update(User $user, OpportunityUnit $model)
    {
        return $user->hasPermissionTo('update opportunityunits');
    }

    /**
     * Determine whether the opportunityUnit can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityUnit  $model
     * @return mixed
     */
    public function delete(User $user, OpportunityUnit $model)
    {
        return $user->hasPermissionTo('delete opportunityunits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityUnit  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete opportunityunits');
    }

    /**
     * Determine whether the opportunityUnit can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityUnit  $model
     * @return mixed
     */
    public function restore(User $user, OpportunityUnit $model)
    {
        return false;
    }

    /**
     * Determine whether the opportunityUnit can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityUnit  $model
     * @return mixed
     */
    public function forceDelete(User $user, OpportunityUnit $model)
    {
        return false;
    }
}
