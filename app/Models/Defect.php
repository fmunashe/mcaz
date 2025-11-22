<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Defect extends Model
{
    /** @use HasFactory<\Database\Factories\DefectFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];

    public function natureOfDefects(): HasMany
    {
        return $this->hasMany(NatureOfDefect::class);
    }
}
