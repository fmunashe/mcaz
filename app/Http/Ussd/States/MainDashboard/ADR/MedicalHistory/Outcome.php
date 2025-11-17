<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\MedicalHistory;

use App\Http\Ussd\States\MainDashboard\ADR\ReporterFullName;
use App\Models\ADROutcome;
use Sparors\Ussd\State;

class Outcome extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Relevant medical history outcome');
        $this->menu->paginateListing([
            'Recovered or resolved',
            'Recovering or resolving',
            'Recovered or resolved with sequelae',
            'Not recovered or not resolved',
            'Fatal',
            'Unknown',
            'Died'
        ], 1, 8, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5, 6, 7])) {
            $this->decision->any(self::class);
            return;
        }
        $this->setOutcome($argument);
        $this->decision->any(ReporterFullName::class);
    }

    protected function setOutcome($option): void
    {
        $outcomes = ADROutcome::all();
        if ($option == 1) {
            $outcome = $outcomes->where('outcome', '=', 'Recovered/resolved')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
        if ($option == 2) {
            $outcome = $outcomes->where('outcome', '=', 'Recovering/resolving')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
        if ($option == 3) {
            $outcome = $outcomes->where('outcome', '=', 'Recovered/resolved with sequelae')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
        if ($option == 4) {
            $outcome = $outcomes->where('outcome', '=', 'Not recovered/not resolved')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
        if ($option == 5) {
            $outcome = $outcomes->where('outcome', '=', 'Fatal')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
        if ($option == 6) {
            $outcome = $outcomes->where('outcome', '=', 'Unknown')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
        if ($option == 7) {
            $outcome = $outcomes->where('outcome', '=', 'Died')->first();
            $this->record->set('adrPastMedicalHistoryOutcomeId', $outcome->id);
        }
    }
}
