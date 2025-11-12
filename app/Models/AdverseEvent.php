<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdverseEvent extends Model
{
    /** @use HasFactory<\Database\Factories\AdverseEventFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function aefiAdverseEvents(): HasMany
    {
        return $this->hasMany(AEFIAdverseEvent::class);
    }
}
