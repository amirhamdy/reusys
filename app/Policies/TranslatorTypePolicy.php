<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TranslatorType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TranslatorTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the translatorType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list translatortypes');
    }

    /**
     * Determine whether the translatorType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorType  $model
     * @return mixed
     */
    public function view(User $user, TranslatorType $model)
    {
        return $user->hasPermissionTo('view translatortypes');
    }

    /**
     * Determine whether the translatorType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create translatortypes');
    }

    /**
     * Determine whether the translatorType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorType  $model
     * @return mixed
     */
    public function update(User $user, TranslatorType $model)
    {
        return $user->hasPermissionTo('update translatortypes');
    }

    /**
     * Determine whether the translatorType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorType  $model
     * @return mixed
     */
    public function delete(User $user, TranslatorType $model)
    {
        return $user->hasPermissionTo('delete translatortypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete translatortypes');
    }

    /**
     * Determine whether the translatorType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorType  $model
     * @return mixed
     */
    public function restore(User $user, TranslatorType $model)
    {
        return false;
    }

    /**
     * Determine whether the translatorType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorType  $model
     * @return mixed
     */
    public function forceDelete(User $user, TranslatorType $model)
    {
        return false;
    }
}
