<?php

namespace App;

use Illuminate\Support\Facades\DB;

trait ClearSession
{
    public function clearSession($sessionId): void
    {
        DB::table('cache')
            ->where('key', 'like', "laravel-cache-ussd_{$sessionId}%")
            ->delete();

    }
}
