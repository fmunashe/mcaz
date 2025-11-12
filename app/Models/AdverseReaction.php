<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdverseReaction extends Model
{
    /** @use HasFactory<\Database\Factories\AdverseReactionFactory> */
    use HasFactory;

    protected $guarded = [];

    public  function adr(): BelongsTo
    {
        return $this->belongsTo(ADR::class);
    }
}
