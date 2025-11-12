<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelevantPastDrugTherapy extends Model
{
    /** @use HasFactory<\Database\Factories\RelevantPastDrugTherapyFactory> */
    use HasFactory;

    protected $guarded =[];

    public function adr(): BelongsTo
    {
        return $this->belongsTo(Adr::class);
    }
}

