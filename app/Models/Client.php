<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;
    use SoftDeletes;
    use HasUuids;

    protected $guarded = [];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function customerComplaints(): HasMany
    {
        return $this->hasMany(CustomerComplaint::class);
    }

    public function aefis(): HasMany
    {
        return $this->hasMany(Aefi::class);
    }

    public function adrs(): HasMany
    {
        return $this->hasMany(ADR::class);
    }

    public function productDefects(): HasMany
    {
        return $this->hasMany(ProductDefect::class);
    }
}
