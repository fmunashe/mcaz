<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UssdMenuOption extends Model
{
    /** @use HasFactory<\Database\Factories\UssdMenuOptionFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable =[
        'menu_id',
        'option_number',
        'option_text',
        'next_menu_id'
    ];
    public function menu(): BelongsTo
    {
        return $this->belongsTo(UssdMenu::class);
    }
}
