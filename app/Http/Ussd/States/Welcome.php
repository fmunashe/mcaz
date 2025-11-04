<?php

namespace App\Http\Ussd\States;

use App\Http\Ussd\Actions\Registration\CheckRegistration;
use App\Http\Ussd\States\Registration\Register;
use Sparors\Ussd\State;

class Welcome extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Welcome to MCAZ')
            ->lineBreak(2)
            ->line("Report medicine or vaccine side effects or product quality issues, or submit a complaint or submit an enquiry.")
            ->lineBreak(2)
            ->paginateListing([
                'Login',
                'Register User',
                'Continue without registering (You won’t be able to be identified and may not receive feedback if you select this option)',
                'Help',
                'Exit'], 1, 5, '. ')
            ->lineBreak(2)
            ->line('9. Next Page')
            ->line('#. Back')
            ->line('Main Menu');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Login::class);
        $this->decision->equal('2', CheckRegistration::class);
        $this->decision->equal('3', ContinueWithoutRegistering::class);
        $this->decision->equal('4', Help::class);
        $this->decision->equal('5', ExitState::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
