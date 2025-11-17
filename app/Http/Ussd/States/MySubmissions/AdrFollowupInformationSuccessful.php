<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class AdrFollowupInformationSuccessful extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Followup information for ADR with reference ' . $this->record->get('adrFollowupReference') . ' added successfully');
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
        $this->decision->any(AddFollowupInformation::class);
    }
}
