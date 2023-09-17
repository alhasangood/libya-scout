<?php

namespace App\Policies;

use App\Models\User;
use App\Models\StoreHouse;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreHousePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the storeHouse can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list storehouses');
    }

    /**
     * Determine whether the storeHouse can view the model.
     */
    public function view(User $user, StoreHouse $model): bool
    {
        return $user->hasPermissionTo('view storehouses');
    }

    /**
     * Determine whether the storeHouse can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create storehouses');
    }

    /**
     * Determine whether the storeHouse can update the model.
     */
    public function update(User $user, StoreHouse $model): bool
    {
        return $user->hasPermissionTo('update storehouses');
    }

    /**
     * Determine whether the storeHouse can delete the model.
     */
    public function delete(User $user, StoreHouse $model): bool
    {
        return $user->hasPermissionTo('delete storehouses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete storehouses');
    }

    /**
     * Determine whether the storeHouse can restore the model.
     */
    public function restore(User $user, StoreHouse $model): bool
    {
        return false;
    }

    /**
     * Determine whether the storeHouse can permanently delete the model.
     */
    public function forceDelete(User $user, StoreHouse $model): bool
    {
        return false;
    }
}
