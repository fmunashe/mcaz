<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReporterDesignation extends Model
{
    /** @use HasFactory<\Database\Factories\ReporterDesignationFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];
}
