<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use App\Models\ReporterDesignation;
use Sparors\Ussd\State;

class Designation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Designation');
        $this->menu->paginateListing([
            'Physician',
            'Pharmacist',
            'Nurse',
            'Other health professional',
            'Lawyer',
            'Consumer or other non-health professional'
        ], 1, 6, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5, 6])) {
            $this->decision->any(self::class);
        }
        if ($argument == 1) {
            $designation = $this->getDesignation('Physician');
            $this->record->set('designation', $designation->designation);
            $this->decision->any(Address::class);
        }
        if ($argument == 2) {
            $designation = $this->getDesignation('Pharmacist');
            $this->record->set('designation', $designation->designation);
            $this->decision->any(Address::class);
        }
        if ($argument == 3) {
            $designation = $this->getDesignation('Nurse');
            $this->record->set('designation', $designation->designation);
            $this->decision->any(Address::class);
        }
        if ($argument == 4) {
            $designation = $this->getDesignation('Other health professional');
            $this->record->set('designation', $designation->designation);
            $this->decision->any(Address::class);
        }
        if ($argument == 5) {
            $designation = $this->getDesignation('Lawyer');
            $this->record->set('designation', $designation->designation);
            $this->decision->any(Address::class);
        }
        if ($argument == 6) {
            $designation = $this->getDesignation('Consumer or other non-health professional');
            $this->record->set('designation', $designation->designation);
            $this->decision->any(Address::class);
        }
    }

    protected function getDesignation(string $designation): bool
    {
        return ReporterDesignation::where('designation', $designation)->first();
    }
}
