<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdverseReaction extends Model
{
    /** @use HasFactory<\Database\Factories\AdverseReactionFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public  function adr(): BelongsTo
    {
        return $this->belongsTo(ADR::class,'a_d_r_id','id');
    }

    public function durations(): BelongsTo
    {
        return $this->belongsTo(Duration::class, 'duration_id', 'id');
    }

    public function aDRSeriousReason(): BelongsTo
    {
        return $this->belongsTo(ADRSeriousReason::class, 'a_d_r_serious_reason_id', 'id');
    }

}
