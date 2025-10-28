<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UssdMenu extends Model
{
    /** @use HasFactory<\Database\Factories\UssdMenuFactory> */
    use HasFactory;
    use SoftDeletes;
    protected $fillable =[
        'code',
        'title',
        'type',
        'next_menu_id'
    ];
    public function options(): HasMany
    {
        return $this->hasMany(UssdMenuOption::class);
    }
}
