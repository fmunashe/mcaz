<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\Reactions;

use Sparors\Ussd\State;

class AdrSerious extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Is the adverse reaction serious');
        $this->menu->paginateListing([
            'Yes',
            'No'
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 1) {
            $this->record->set('adrSerious', 'Yes');
        }
        if ($argument == 2) {
            $this->record->set('adrSerious', 'No');
        }
        $this->decision->any(ReasonForSeriousness::class);
    }
}
