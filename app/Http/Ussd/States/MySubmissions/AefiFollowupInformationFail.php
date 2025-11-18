<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class AefiFollowupInformationFail extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('AEFI with reference ' . $this->record->get('aefiFollowupReference') . ' not found');
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
            $this->decision->equal('1', AefiFollowupInformation::class);
        }
        if ($argument == 2) {
            $this->decision->equal('2', AddFollowupInformation::class);
        }
        $this->decision->any(AddFollowupInformation::class);
    }
}
