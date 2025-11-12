<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AEFIAdverseEvent extends Model
{
    /** @use HasFactory<\Database\Factories\AEFIAdverseEventFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function aefi(): BelongsTo
    {
        return $this->belongsTo(AEFI::class);
    }

    public function adverseEvent(): BelongsTo
    {
        return $this->belongsTo(AdverseEvent::class);
    }
}
