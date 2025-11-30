<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelevantMedicalHistory extends Model
{
    /** @use HasFactory<\Database\Factories\RelevantMedicalHistoryFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded =[];

    function adr(): BelongsTo
    {
        return $this->belongsTo(Adr::class);
    }

    function actionTaken(): BelongsTo
    {
        return $this->belongsTo(ActionTaken::class);
    }

    function a_d_r_outcome(): BelongsTo
    {
        return $this->belongsTo(ADROutcome::class);
    }
}
