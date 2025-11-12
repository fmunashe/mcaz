<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    /** @use HasFactory<\Database\Factories\DurationFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = ['duration'];
}
