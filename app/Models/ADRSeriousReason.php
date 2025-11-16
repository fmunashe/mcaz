<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ADRSeriousReason extends Model
{
    /** @use HasFactory<\Database\Factories\ADRSeriousReasonFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = ['reason'];

    public function aefiSeverities(): HasMany
    {
        return $this->hasMany(AEFISeverity::class);
    }
}
