<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vaccine extends Model
{
    /** @use HasFactory<\Database\Factories\VaccineFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded =[];

    public function aefi(): BelongsTo
    {
        return $this->belongsTo(AEFI::class);
    }
}
