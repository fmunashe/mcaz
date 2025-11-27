<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\AdverseEvents;

use Sparors\Ussd\State;

class AdverseEvent extends State
{
    protected function beforeRendering(): void
    {
            $this->menu->paginateListing([
                'Severe local reaction',
                'Seizures',
                'Abscess',
                'Sepsis',
                'Encephalopathy',
                'Toxic shock syndrome',
                'Thrombocytopenia',
                'Anaphylaxis',
                'Fever',
                'Beyond nearest joint',
                'Febrile',
                'Afebrile',
                'Other'
            ], 1, 2, '. ');

    }

    protected function afterRendering(string $argument): void
    {
        // to be implemented
    }
}
