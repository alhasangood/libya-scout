<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TransprterType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransprterTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transprterType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list transprtertypes');
    }

    /**
     * Determine whether the transprterType can view the model.
     */
    public function view(User $user, TransprterType $model): bool
    {
        return $user->hasPermissionTo('view transprtertypes');
    }

    /**
     * Determine whether the transprterType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create transprtertypes');
    }

    /**
     * Determine whether the transprterType can update the model.
     */
    public function update(User $user, TransprterType $model): bool
    {
        return $user->hasPermissionTo('update transprtertypes');
    }

    /**
     * Determine whether the transprterType can delete the model.
     */
    public function delete(User $user, TransprterType $model): bool
    {
        return $user->hasPermissionTo('delete transprtertypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete transprtertypes');
    }

    /**
     * Determine whether the transprterType can restore the model.
     */
    public function restore(User $user, TransprterType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the transprterType can permanently delete the model.
     */
    public function forceDelete(User $user, TransprterType $model): bool
    {
        return false;
    }
}
