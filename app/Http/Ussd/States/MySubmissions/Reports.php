<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class Reports extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Reports can be accessed from this link');
        $this->menu->line('https://www.mcaz.co.zw/');
        $this->menu->paginateListing([
            'Back',
        ], 1, 1, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || $argument != 1) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->any(MySubmissions::class);
    }
}
