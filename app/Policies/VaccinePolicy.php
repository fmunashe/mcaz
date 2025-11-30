<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vaccine;

class VaccinePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Vaccine $vaccine): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_view');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Vaccine $vaccine): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Vaccine $vaccine): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Vaccine $vaccine): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Vaccine $vaccine): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'vaccine_delete');
        })->exists();
    }
}
