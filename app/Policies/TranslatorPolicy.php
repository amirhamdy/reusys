<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Translator;
use Illuminate\Auth\Access\HandlesAuthorization;

class TranslatorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the translator can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list translators');
    }

    /**
     * Determine whether the translator can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Translator  $model
     * @return mixed
     */
    public function view(User $user, Translator $model)
    {
        return $user->hasPermissionTo('view translators');
    }

    /**
     * Determine whether the translator can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create translators');
    }

    /**
     * Determine whether the translator can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Translator  $model
     * @return mixed
     */
    public function update(User $user, Translator $model)
    {
        return $user->hasPermissionTo('update translators');
    }

    /**
     * Determine whether the translator can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Translator  $model
     * @return mixed
     */
    public function delete(User $user, Translator $model)
    {
        return $user->hasPermissionTo('delete translators');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Translator  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete translators');
    }

    /**
     * Determine whether the translator can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Translator  $model
     * @return mixed
     */
    public function restore(User $user, Translator $model)
    {
        return false;
    }

    /**
     * Determine whether the translator can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Translator  $model
     * @return mixed
     */
    public function forceDelete(User $user, Translator $model)
    {
        return false;
    }
}
