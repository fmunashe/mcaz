<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionTaken extends Model
{
    /** @use HasFactory<\Database\Factories\ActionTakenFactory> */
    use HasFactory;
    use HasUuids;
    protected $fillable =['action_taken'];
}
