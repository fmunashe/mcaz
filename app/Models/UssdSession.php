<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'msisdn',
        'current_menu_id',
        'input_data',
        'status'
    ];
}
