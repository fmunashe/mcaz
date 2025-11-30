<?php

namespace App\Policies;

use App\Models\RelevantMedicalHistory;
use App\Models\User;

class RelevantMedicalHistoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_access');
        })->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RelevantMedicalHistory $relevantMedicalHistory): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_view');
        })->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_create');
        })->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RelevantMedicalHistory $relevantMedicalHistory): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_edit');
        })->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RelevantMedicalHistory $relevantMedicalHistory): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_delete');
        })->exists();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RelevantMedicalHistory $relevantMedicalHistory): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_delete');
        })->exists();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RelevantMedicalHistory $relevantMedicalHistory): bool
    {
        return $user->roles()->whereHas('permissions', function ($query) {
            $query->where('title', 'medical_history_delete');
        })->exists();
    }
}
