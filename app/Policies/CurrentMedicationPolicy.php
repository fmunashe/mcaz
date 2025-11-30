<?php

namespace App\Policies;

use App\Models\CurrentMedication;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CurrentMedicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CurrentMedication $currentMedication): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_view');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CurrentMedication $currentMedication): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CurrentMedication $currentMedication): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CurrentMedication $currentMedication): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CurrentMedication $currentMedication): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'current_medication_delete');
        })->exists();
    }
}
