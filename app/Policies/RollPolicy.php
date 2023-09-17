<?php

namespace App\Policies;

use App\Models\Roll;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RollPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the roll can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list rolls');
    }

    /**
     * Determine whether the roll can view the model.
     */
    public function view(User $user, Roll $model): bool
    {
        return $user->hasPermissionTo('view rolls');
    }

    /**
     * Determine whether the roll can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create rolls');
    }

    /**
     * Determine whether the roll can update the model.
     */
    public function update(User $user, Roll $model): bool
    {
        return $user->hasPermissionTo('update rolls');
    }

    /**
     * Determine whether the roll can delete the model.
     */
    public function delete(User $user, Roll $model): bool
    {
        return $user->hasPermissionTo('delete rolls');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete rolls');
    }

    /**
     * Determine whether the roll can restore the model.
     */
    public function restore(User $user, Roll $model): bool
    {
        return false;
    }

    /**
     * Determine whether the roll can permanently delete the model.
     */
    public function forceDelete(User $user, Roll $model): bool
    {
        return false;
    }
}
