<?php

namespace App\Http\Ussd\States\MySubmissions;

use Sparors\Ussd\State;

class AddFollowupInformation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Select option to add followup information');
        $this->menu->paginateListing([
            'ADR',
            'AEFI',
            'Product Quality Problem',
            'Back'
        ], 1, 4, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4])) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', AdrReference::class);
        $this->decision->equal('2', AefiReference::class);
        $this->decision->equal('3', ProductDefectReference::class);
        $this->decision->equal('4', MySubmissions::class);
        $this->decision->any(AddFollowupInformation::class);
    }
}
