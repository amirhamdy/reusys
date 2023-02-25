<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InvoiceJob;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoiceJobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the invoiceJob can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list invoicejobs');
    }

    /**
     * Determine whether the invoiceJob can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InvoiceJob  $model
     * @return mixed
     */
    public function view(User $user, InvoiceJob $model)
    {
        return $user->hasPermissionTo('view invoicejobs');
    }

    /**
     * Determine whether the invoiceJob can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create invoicejobs');
    }

    /**
     * Determine whether the invoiceJob can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InvoiceJob  $model
     * @return mixed
     */
    public function update(User $user, InvoiceJob $model)
    {
        return $user->hasPermissionTo('update invoicejobs');
    }

    /**
     * Determine whether the invoiceJob can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InvoiceJob  $model
     * @return mixed
     */
    public function delete(User $user, InvoiceJob $model)
    {
        return $user->hasPermissionTo('delete invoicejobs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InvoiceJob  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete invoicejobs');
    }

    /**
     * Determine whether the invoiceJob can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InvoiceJob  $model
     * @return mixed
     */
    public function restore(User $user, InvoiceJob $model)
    {
        return false;
    }

    /**
     * Determine whether the invoiceJob can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\InvoiceJob  $model
     * @return mixed
     */
    public function forceDelete(User $user, InvoiceJob $model)
    {
        return false;
    }
}
