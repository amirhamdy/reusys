<?php

namespace App\Policies;

use App\Models\User;
use App\Models\OpportunityType;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpportunityTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the opportunityType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list opportunitytypes');
    }

    /**
     * Determine whether the opportunityType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityType  $model
     * @return mixed
     */
    public function view(User $user, OpportunityType $model)
    {
        return $user->hasPermissionTo('view opportunitytypes');
    }

    /**
     * Determine whether the opportunityType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create opportunitytypes');
    }

    /**
     * Determine whether the opportunityType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityType  $model
     * @return mixed
     */
    public function update(User $user, OpportunityType $model)
    {
        return $user->hasPermissionTo('update opportunitytypes');
    }

    /**
     * Determine whether the opportunityType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityType  $model
     * @return mixed
     */
    public function delete(User $user, OpportunityType $model)
    {
        return $user->hasPermissionTo('delete opportunitytypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete opportunitytypes');
    }

    /**
     * Determine whether the opportunityType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityType  $model
     * @return mixed
     */
    public function restore(User $user, OpportunityType $model)
    {
        return false;
    }

    /**
     * Determine whether the opportunityType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\OpportunityType  $model
     * @return mixed
     */
    public function forceDelete(User $user, OpportunityType $model)
    {
        return false;
    }
}
