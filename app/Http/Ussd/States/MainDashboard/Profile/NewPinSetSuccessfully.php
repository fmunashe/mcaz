<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class NewPinSetSuccessfully extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));
        $client->update([
            'pin' => $this->record->get('newPin')
        ]);
        $this->menu->text('New pin set successfully');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Back',
            'Main Menu'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', ChangePinOrPassword::class);
        $this->decision->equal('2', Dashboard::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
