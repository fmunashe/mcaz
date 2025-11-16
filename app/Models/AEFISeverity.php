<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AEFISeverity extends Model
{
    /** @use HasFactory<\Database\Factories\AEFISeverityFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function aefi(): BelongsTo
    {
        return $this->belongsTo(AEFI::class);
    }

    public function seriousReason(): BelongsTo
    {
        return $this->belongsTo(ADRSeriousReason::class);
    }
}
