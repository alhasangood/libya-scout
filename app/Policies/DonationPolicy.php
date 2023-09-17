<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the donation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list donations');
    }

    /**
     * Determine whether the donation can view the model.
     */
    public function view(User $user, Donation $model): bool
    {
        return $user->hasPermissionTo('view donations');
    }

    /**
     * Determine whether the donation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create donations');
    }

    /**
     * Determine whether the donation can update the model.
     */
    public function update(User $user, Donation $model): bool
    {
        return $user->hasPermissionTo('update donations');
    }

    /**
     * Determine whether the donation can delete the model.
     */
    public function delete(User $user, Donation $model): bool
    {
        return $user->hasPermissionTo('delete donations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete donations');
    }

    /**
     * Determine whether the donation can restore the model.
     */
    public function restore(User $user, Donation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the donation can permanently delete the model.
     */
    public function forceDelete(User $user, Donation $model): bool
    {
        return false;
    }
}
