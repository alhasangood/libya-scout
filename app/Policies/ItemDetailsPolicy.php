<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ItemDetails;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemDetailsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the itemDetails can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allitemdetails');
    }

    /**
     * Determine whether the itemDetails can view the model.
     */
    public function view(User $user, ItemDetails $model): bool
    {
        return $user->hasPermissionTo('view allitemdetails');
    }

    /**
     * Determine whether the itemDetails can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allitemdetails');
    }

    /**
     * Determine whether the itemDetails can update the model.
     */
    public function update(User $user, ItemDetails $model): bool
    {
        return $user->hasPermissionTo('update allitemdetails');
    }

    /**
     * Determine whether the itemDetails can delete the model.
     */
    public function delete(User $user, ItemDetails $model): bool
    {
        return $user->hasPermissionTo('delete allitemdetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allitemdetails');
    }

    /**
     * Determine whether the itemDetails can restore the model.
     */
    public function restore(User $user, ItemDetails $model): bool
    {
        return false;
    }

    /**
     * Determine whether the itemDetails can permanently delete the model.
     */
    public function forceDelete(User $user, ItemDetails $model): bool
    {
        return false;
    }
}
