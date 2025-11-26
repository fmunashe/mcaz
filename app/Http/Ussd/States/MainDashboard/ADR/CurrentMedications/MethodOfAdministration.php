<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Sparors\Ussd\State;

class MethodOfAdministration extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('How was the medicine administered e.g oral, injection into muscle (intramuscular, into the eye, inhalation etc)');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('administrationMethod'.$currentCount, $argument);
        $this->decision->any(DateStarted::class);
    }
}
