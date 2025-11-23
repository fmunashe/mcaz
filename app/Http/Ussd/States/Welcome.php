<?php

namespace App\Http\Ussd\States;

use App\ClearSession;
use App\Http\Ussd\Actions\Registration\CheckRegistration;
use App\Http\Ussd\States\GuestMenu\ContinueWithoutRegistering;
use App\Http\Ussd\States\Help\HelpAndSupport;
use Sparors\Ussd\State;

class Welcome extends State
{
    use ClearSession;

    protected function beforeRendering(): void
    {
        $this->clearSession($this->record->get('sessionId'));
        $this->menu->line('Welcome to MCAZ')
            ->line("Report medicine or vaccine side effects or product quality issues or submit a complaint or submit an enquiry.")
            ->paginateListing([
                'Login',
                'Register User',
                'Continue without registering (You won’t be able to be identified and may not receive feedback if you select this option)',
                'Help',
                'Exit'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->record->set('isLoggedIn', false);
        $this->decision->equal('1', Login::class);
        $this->decision->equal('2', CheckRegistration::class);
        $this->decision->equal('3', ContinueWithoutRegistering::class);
        $this->decision->equal('4', HelpAndSupport::class);
        $this->decision->equal('5', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
