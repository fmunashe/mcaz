<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerComplaint extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerComplaintFactory> */
    use HasFactory;
    use HasUuids;

    protected $guarded = [];
}
