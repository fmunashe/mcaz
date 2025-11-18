<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AEFI extends Model
{
    /** @use HasFactory<\Database\Factories\AEFIFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function vaccines(): HasMany
    {
        return $this->hasMany(Vaccine::class);
    }

    public function adverseEvents(): HasMany
    {
        return $this->hasMany(AEFIAdverseEvent::class);
    }

    public function ageGroup(): BelongsTo
    {
        return $this->belongsTo(AgeGroup::class);
    }

    public function severity(): HasMany
    {
        return $this->hasMany(AEFISeverity::class);
    }

    protected function aefiFollowupInformation(): HasMany
    {
        return $this->hasMany(AEFIFollowupInformation::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
