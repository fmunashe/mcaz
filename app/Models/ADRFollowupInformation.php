<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ADRFollowupInformation extends Model
{
    /** @use HasFactory<\Database\Factories\ADRFollowupInformationFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded =[];

    public function adrReport(): BelongsTo
    {
       return $this->belongsTo(ADR::class);
    }
}
