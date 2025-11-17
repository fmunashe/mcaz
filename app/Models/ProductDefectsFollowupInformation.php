<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDefectsFollowupInformation extends Model
{
    /** @use HasFactory<\Database\Factories\ProductDefectsFollowupInformationFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function productDefect(): BelongsTo
    {
        return $this->belongsTo(ProductDefect::class);
    }
}
