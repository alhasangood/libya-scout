<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScoutCommission;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScoutCommissionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the scoutCommission can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list scoutcommissions');
    }

    /**
     * Determine whether the scoutCommission can view the model.
     */
    public function view(User $user, ScoutCommission $model): bool
    {
        return $user->hasPermissionTo('view scoutcommissions');
    }

    /**
     * Determine whether the scoutCommission can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create scoutcommissions');
    }

    /**
     * Determine whether the scoutCommission can update the model.
     */
    public function update(User $user, ScoutCommission $model): bool
    {
        return $user->hasPermissionTo('update scoutcommissions');
    }

    /**
     * Determine whether the scoutCommission can delete the model.
     */
    public function delete(User $user, ScoutCommission $model): bool
    {
        return $user->hasPermissionTo('delete scoutcommissions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete scoutcommissions');
    }

    /**
     * Determine whether the scoutCommission can restore the model.
     */
    public function restore(User $user, ScoutCommission $model): bool
    {
        return false;
    }

    /**
     * Determine whether the scoutCommission can permanently delete the model.
     */
    public function forceDelete(User $user, ScoutCommission $model): bool
    {
        return false;
    }
}
