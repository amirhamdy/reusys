<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SubjectMatter;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectMatterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subjectMatter can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list subjectmatters');
    }

    /**
     * Determine whether the subjectMatter can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubjectMatter  $model
     * @return mixed
     */
    public function view(User $user, SubjectMatter $model)
    {
        return $user->hasPermissionTo('view subjectmatters');
    }

    /**
     * Determine whether the subjectMatter can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create subjectmatters');
    }

    /**
     * Determine whether the subjectMatter can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubjectMatter  $model
     * @return mixed
     */
    public function update(User $user, SubjectMatter $model)
    {
        return $user->hasPermissionTo('update subjectmatters');
    }

    /**
     * Determine whether the subjectMatter can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubjectMatter  $model
     * @return mixed
     */
    public function delete(User $user, SubjectMatter $model)
    {
        return $user->hasPermissionTo('delete subjectmatters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubjectMatter  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete subjectmatters');
    }

    /**
     * Determine whether the subjectMatter can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubjectMatter  $model
     * @return mixed
     */
    public function restore(User $user, SubjectMatter $model)
    {
        return false;
    }

    /**
     * Determine whether the subjectMatter can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\SubjectMatter  $model
     * @return mixed
     */
    public function forceDelete(User $user, SubjectMatter $model)
    {
        return false;
    }
}
