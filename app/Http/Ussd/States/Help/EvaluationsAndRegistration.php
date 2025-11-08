<?php

namespace App\Http\Ussd\States\Help;

use Sparors\Ussd\State;

class EvaluationsAndRegistration extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->paginateListing([
            'Conventional Medicines : ConvEVR@mcaz.co.zw',
            'Veterinary Medicines : VetEVR@mcaz.co.zw',
            'Complementary Medicines : CompEVR@mcaz.co.zw',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->any(ContactMcazSupport::class);
    }
}
