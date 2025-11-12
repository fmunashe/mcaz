<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ADRSeriousReason extends Model
{
    /** @use HasFactory<\Database\Factories\ADRSeriousReasonFactory> */
    use HasFactory;

    protected $fillable = ['reason'];
}
