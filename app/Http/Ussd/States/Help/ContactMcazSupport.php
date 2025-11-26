<?php

namespace App\Http\Ussd\States\Help;

use App\Http\Ussd\Actions\CheckLoggedIn;
use App\Http\Ussd\States\InvalidMenuSelection;
use Sparors\Ussd\State;

class ContactMcazSupport extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Divisions Email Contacts');
        $this->menu->paginateListing([
            'Licensing and Enforcement',
            'Evaluations and Registration',
            'Pharmacovigilance and Clinical Trials',
            'ICT Unit',
            'Customer Service',
            'Toll Free Numbers',
            'Talk to an agent',
            'Back'], 1, 10, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5, 6, 7,8])) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', LicensingAndEnforcement::class);
        $this->decision->equal('2', EvaluationsAndRegistration::class);
        $this->decision->equal('3', PharmacovigilanceAndClinicalTrials::class);
        $this->decision->equal('4', ICTUnit::class);
        $this->decision->equal('5', CustomerService::class);
        $this->decision->equal('6', TollFreeNumbers::class);
        $this->decision->equal('7', TalkToAgent::class);
        $this->decision->equal('8', CheckLoggedIn::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
