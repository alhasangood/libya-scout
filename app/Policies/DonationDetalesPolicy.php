<?php

namespace App\Policies;

use App\Models\User;
use App\Models\DonationDetales;
use Illuminate\Auth\Access\HandlesAuthorization;

class DonationDetalesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the donationDetales can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list alldonationdetales');
    }

    /**
     * Determine whether the donationDetales can view the model.
     */
    public function view(User $user, DonationDetales $model): bool
    {
        return $user->hasPermissionTo('view alldonationdetales');
    }

    /**
     * Determine whether the donationDetales can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create alldonationdetales');
    }

    /**
     * Determine whether the donationDetales can update the model.
     */
    public function update(User $user, DonationDetales $model): bool
    {
        return $user->hasPermissionTo('update alldonationdetales');
    }

    /**
     * Determine whether the donationDetales can delete the model.
     */
    public function delete(User $user, DonationDetales $model): bool
    {
        return $user->hasPermissionTo('delete alldonationdetales');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete alldonationdetales');
    }

    /**
     * Determine whether the donationDetales can restore the model.
     */
    public function restore(User $user, DonationDetales $model): bool
    {
        return false;
    }

    /**
     * Determine whether the donationDetales can permanently delete the model.
     */
    public function forceDelete(User $user, DonationDetales $model): bool
    {
        return false;
    }
}
