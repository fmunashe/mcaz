<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Duration extends Model
{
    /** @use HasFactory<\Database\Factories\DurationFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = ['duration'];
    
    protected $keyType = 'string';
    public $incrementing = false;

    public function adverseReactions(): HasMany
    {
        return $this->hasMany(AdverseReaction::class, 'duration_id', 'id');
    }
}
