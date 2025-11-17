<?php

namespace App\Http\Ussd\States\MainDashboard\ADR;

use Sparors\Ussd\State;

class VctNumber extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('VCT or OI or TB number');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
        }
        $this->record->set('vctNumber', $argument);
        $this->decision->any(Weight::class);
    }
}
