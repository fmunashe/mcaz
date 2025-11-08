<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class PharmacovigilanceAndClinicalTrials extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->paginateListing([
            'PVCT Related : pvct@mcaz.co.zw',
            'Retention fees : retentions@mcaz.co.zw',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(ContactMcazSupport::class);
    }
}
