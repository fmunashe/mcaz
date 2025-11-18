<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class AefiReference extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter the reference number of the AEFI you want to add followup information');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('aefiFollowupReference', $argument);
        $this->decision->any(AefiFollowupInformation::class);
    }
}
