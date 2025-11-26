<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\Outcome;

use App\Http\Ussd\States\MainDashboard\AEFI\DateOfDeath;
use App\Http\Ussd\States\MainDashboard\AEFI\RelevantPastMedicalHistory\LabTestResult;
use App\Models\ADROutcome;
use Sparors\Ussd\State;

class Outcome extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Outcome');
        $this->menu->paginateListing([
            'Recovered or resolved',
            'Recovering or resolving',
            'Recovered or resolved with sequelae',
            'Not recovered or not resolved',
            'Unknown',
            'Died'
        ], 1, 8, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (in_array($argument, [1, 2, 3, 4, 5, 6])) {
            $this->setOutcome($argument);
            if ($argument == 6) {
                $this->decision->any(DateOfDeath::class);
            } else {
                $this->decision->any(LabTestResult::class);
            }
        }
        $this->decision->any(Outcome::class);
    }

    protected function setOutcome($option): void
    {
        $outcomes = ADROutcome::all();
        if ($option == 1) {
            $outcome = $outcomes->where('outcome', '=', 'Recovered/resolved')->first();
            $this->record->set('aefiOutcomeId', $outcome->id);
            $this->record->set('aefiOutcomeName', $outcome->outcome);
        }
        if ($option == 2) {
            $outcome = $outcomes->where('outcome', '=', 'Recovering/resolving')->first();
            $this->record->set('aefiOutcomeId', $outcome->id);
            $this->record->set('aefiOutcomeName', $outcome->outcome);
        }
        if ($option == 3) {
            $outcome = $outcomes->where('outcome', '=', 'Recovered/resolved with sequelae')->first();
            $this->record->set('aefiOutcomeId', $outcome->id);
            $this->record->set('aefiOutcomeName', $outcome->outcome);
        }
        if ($option == 4) {
            $outcome = $outcomes->where('outcome', '=', 'Not recovered/not resolved')->first();
            $this->record->set('aefiOutcomeId', $outcome->id);
            $this->record->set('aefiOutcomeName', $outcome->outcome);
        }
        if ($option == 5) {
            $outcome = $outcomes->where('outcome', '=', 'Unknown')->first();
            $this->record->set('aefiOutcomeId', $outcome->id);
            $this->record->set('aefiOutcomeName', $outcome->outcome);
        }
        if ($option == 6) {
            $outcome = $outcomes->where('outcome', '=', 'Died')->first();
            $this->record->set('aefiOutcomeId', $outcome->id);
            $this->record->set('aefiOutcomeName', $outcome->outcome);
        }
    }
}
