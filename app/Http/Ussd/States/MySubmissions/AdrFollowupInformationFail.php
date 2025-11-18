<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class AdrFollowupInformationFail extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('ADR with reference ' . $this->record->get('adrFollowupReference') . ' not found');
        $this->menu->paginateListing([
            'Try again',
            'Back',
        ], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 1) {
            $this->decision->equal('1', AdrFollowupInformation::class);
        }
        if ($argument == 2) {
            $this->decision->equal('2', AddFollowupInformation::class);
        }
        $this->decision->any(AddFollowupInformation::class);
    }
}
