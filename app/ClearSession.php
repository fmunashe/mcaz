<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait ClearSession
{
    public function clearSession($sessionId): void
    {
        $appName = Str::lower(env('APP_NAME'));
        DB::table('cache')
            ->where('key', 'like', "{$appName}-cache-ussd_{$sessionId}%")
            ->delete();

    }
}
