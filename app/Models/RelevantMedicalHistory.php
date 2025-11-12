<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelevantMedicalHistory extends Model
{
    /** @use HasFactory<\Database\Factories\RelevantMedicalHistoryFactory> */
    use HasFactory;

    protected $guarded =[];

    function adr(): BelongsTo
    {
        return $this->belongsTo(Adr::class);
    }
}
