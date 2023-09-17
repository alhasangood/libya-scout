<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DonationEntity;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonationEntityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the donationEntity can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list donationentities');
    }

    /**
     * Determine whether the donationEntity can view the model.
     */
    public function view(User $user, DonationEntity $model): bool
    {
        return $user->hasPermissionTo('view donationentities');
    }

    /**
     * Determine whether the donationEntity can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create donationentities');
    }

    /**
     * Determine whether the donationEntity can update the model.
     */
    public function update(User $user, DonationEntity $model): bool
    {
        return $user->hasPermissionTo('update donationentities');
    }

    /**
     * Determine whether the donationEntity can delete the model.
     */
    public function delete(User $user, DonationEntity $model): bool
    {
        return $user->hasPermissionTo('delete donationentities');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete donationentities');
    }

    /**
     * Determine whether the donationEntity can restore the model.
     */
    public function restore(User $user, DonationEntity $model): bool
    {
        return false;
    }

    /**
     * Determine whether the donationEntity can permanently delete the model.
     */
    public function forceDelete(User $user, DonationEntity $model): bool
    {
        return false;
    }
}
