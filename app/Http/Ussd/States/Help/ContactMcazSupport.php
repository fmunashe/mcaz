<?php

namespace App\Http\Ussd\States\Help;

use App\Http\Ussd\Actions\CheckLoggedIn;
use App\Http\Ussd\States\InvalidMenuSelection;
use Sparors\Ussd\State;

class ContactMcazSupport extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Divisions Email Contacts');
        $this->menu->lineBreak(2);
        $this->menu->paginateListing([
            'Licensing and Enforcement',
            'Evaluations and Registration',
            'Pharmacovigilance and Clinical Trials',
            'ICT Unit',
            'Customer Service',
            'Toll Free Numbers',
            'Back'], 1, 10, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', LicensingAndEnforcement::class);
        $this->decision->equal('2', EvaluationsAndRegistration::class);
        $this->decision->equal('3', PharmacovigilanceAndClinicalTrials::class);
        $this->decision->equal('4', ICTUnit::class);
        $this->decision->equal('5', CustomerService::class);
        $this->decision->equal('6', TollFreeNumbers::class);
        $this->decision->equal('7', CheckLoggedIn::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
