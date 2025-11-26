<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI\RelevantPastMedicalHistory;

use Sparors\Ussd\State;

class ActionTaken extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Action taken');
        $this->menu->paginateListing([
            'Dose increased',
            'Dose reduced',
            'Drug withdrawn',
            'Dose not changed',
            'Not applicable',
            'Unknown'
        ], 1, 6, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (in_array($argument, [1, 2, 3, 4, 5, 6])) {
            $this->setActionTaken($argument);
            $this->decision->any(Outcome::class);
        }
        $this->decision->any(ActionTaken::class);
    }

    private function setActionTaken($option): void
    {
        $actions = \App\Models\ActionTaken::all();
        if ($option == '1') {
            $action = $actions->where('action_taken', '=', 'Dose increased')->first();
            $this->record->set('actionTaken', $action->id);
        }
        if ($option == '2') {
            $action = $actions->where('action_taken', '=', 'Dose reduced')->first();
            $this->record->set('actionTaken', $action->id);
        }
        if ($option == '3') {
            $action = $actions->where('action_taken', '=', 'Drug withdrawn')->first();
            $this->record->set('actionTaken', $action->id);
        }
        if ($option == '4') {
            $action = $actions->where('action_taken', '=', 'Dose not changed')->first();
            $this->record->set('actionTaken', $action->id);
        }
        if ($option == '5') {
            $action = $actions->where('action_taken', '=', 'Not applicable')->first();
            $this->record->set('actionTaken', $action->id);
        }
        if ($option == '6') {
            $action = $actions->where('action_taken', '=', 'Unknown')->first();
            $this->record->set('actionTaken', $action->id);
        }
    }
}
