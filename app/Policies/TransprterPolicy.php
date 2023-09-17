<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transprter;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransprterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transprter can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list transprters');
    }

    /**
     * Determine whether the transprter can view the model.
     */
    public function view(User $user, Transprter $model): bool
    {
        return $user->hasPermissionTo('view transprters');
    }

    /**
     * Determine whether the transprter can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create transprters');
    }

    /**
     * Determine whether the transprter can update the model.
     */
    public function update(User $user, Transprter $model): bool
    {
        return $user->hasPermissionTo('update transprters');
    }

    /**
     * Determine whether the transprter can delete the model.
     */
    public function delete(User $user, Transprter $model): bool
    {
        return $user->hasPermissionTo('delete transprters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete transprters');
    }

    /**
     * Determine whether the transprter can restore the model.
     */
    public function restore(User $user, Transprter $model): bool
    {
        return false;
    }

    /**
     * Determine whether the transprter can permanently delete the model.
     */
    public function forceDelete(User $user, Transprter $model): bool
    {
        return false;
    }
}
