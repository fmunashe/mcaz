<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ADR extends Model
{
    /** @use HasFactory<\Database\Factories\ADRFactory> */
    use HasFactory;
    use HasUuids;
    protected $guarded = [];

    public function adverseReactions(): HasMany
    {
        return $this->hasMany(AdverseReaction::class);
    }

    public function pastDrugTherapy(): HasMany
    {
        return $this->hasMany(RelevantPastDrugTherapy::class);
    }

    public function currentMedications(): HasMany
    {
        return $this->hasMany(CurrentMedication::class);
    }

    public function medicalHistory(): HasMany
    {
        return $this->hasMany(RelevantMedicalHistory::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }
}
