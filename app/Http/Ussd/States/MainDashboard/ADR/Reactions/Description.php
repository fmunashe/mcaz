<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\Reactions;

use Sparors\Ussd\State;

class Description extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter adverse reaction description');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('description', $argument);
        $this->decision->any(AdrSerious::class);
    }
}
