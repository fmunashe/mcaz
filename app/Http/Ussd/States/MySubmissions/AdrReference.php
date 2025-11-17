<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class AdrReference extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter the reference number of the ADR you want to add followup information');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('adrFollowupReference', $argument);
        $this->decision->any(AdrFollowupInformation::class);
    }
}
