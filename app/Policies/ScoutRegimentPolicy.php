<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ScoutRegiment;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScoutRegimentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the scoutRegiment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list scoutregiments');
    }

    /**
     * Determine whether the scoutRegiment can view the model.
     */
    public function view(User $user, ScoutRegiment $model): bool
    {
        return $user->hasPermissionTo('view scoutregiments');
    }

    /**
     * Determine whether the scoutRegiment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create scoutregiments');
    }

    /**
     * Determine whether the scoutRegiment can update the model.
     */
    public function update(User $user, ScoutRegiment $model): bool
    {
        return $user->hasPermissionTo('update scoutregiments');
    }

    /**
     * Determine whether the scoutRegiment can delete the model.
     */
    public function delete(User $user, ScoutRegiment $model): bool
    {
        return $user->hasPermissionTo('delete scoutregiments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete scoutregiments');
    }

    /**
     * Determine whether the scoutRegiment can restore the model.
     */
    public function restore(User $user, ScoutRegiment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the scoutRegiment can permanently delete the model.
     */
    public function forceDelete(User $user, ScoutRegiment $model): bool
    {
        return false;
    }
}
