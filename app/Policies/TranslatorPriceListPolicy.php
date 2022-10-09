<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TranslatorPriceList;
use Illuminate\Auth\Access\HandlesAuthorization;

class TranslatorPriceListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the translatorPriceList can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list translatorpricelists');
    }

    /**
     * Determine whether the translatorPriceList can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorPriceList  $model
     * @return mixed
     */
    public function view(User $user, TranslatorPriceList $model)
    {
        return $user->hasPermissionTo('view translatorpricelists');
    }

    /**
     * Determine whether the translatorPriceList can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create translatorpricelists');
    }

    /**
     * Determine whether the translatorPriceList can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorPriceList  $model
     * @return mixed
     */
    public function update(User $user, TranslatorPriceList $model)
    {
        return $user->hasPermissionTo('update translatorpricelists');
    }

    /**
     * Determine whether the translatorPriceList can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorPriceList  $model
     * @return mixed
     */
    public function delete(User $user, TranslatorPriceList $model)
    {
        return $user->hasPermissionTo('delete translatorpricelists');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorPriceList  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete translatorpricelists');
    }

    /**
     * Determine whether the translatorPriceList can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorPriceList  $model
     * @return mixed
     */
    public function restore(User $user, TranslatorPriceList $model)
    {
        return false;
    }

    /**
     * Determine whether the translatorPriceList can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TranslatorPriceList  $model
     * @return mixed
     */
    public function forceDelete(User $user, TranslatorPriceList $model)
    {
        return false;
    }
}
