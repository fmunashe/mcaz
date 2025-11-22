<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NatureOfDefect extends Model
{
    /** @use HasFactory<\Database\Factories\NatureOfDefectFactory> */
    use HasFactory;
    use HasUuids;
    protected $guarded =[];

    public function productDefect(): BelongsTo
    {
        return $this->belongsTo(ProductDefect::class, 'product_defect_id');
    }

    public function defect(): BelongsTo
    {
        return $this->belongsTo(Defect::class);
    }
}
