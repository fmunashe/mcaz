<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ADROutcome extends Model
{
    /** @use HasFactory<\Database\Factories\ADROutcomeFactory> */
    use HasFactory;

    protected $fillable = ['outcome'];
}
