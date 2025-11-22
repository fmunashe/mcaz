<?php

namespace App\Policies;

use App\Models\AEFI;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AEFIPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AEFI $aEFI): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_access');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AEFI $aEFI): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AEFI $aEFI): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AEFI $aEFI): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AEFI $aEFI): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'aefi_delete');
        })->exists();
    }
}
