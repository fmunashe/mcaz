<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\States\InvalidMenuSelection;
use App\Http\Ussd\States\Welcome;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class PrivacyAndDeactivationSuccessful extends State
{
    use UssdLoggedInUser;

    protected $action = self::PROMPT;

    protected function beforeRendering(): void
    {
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));
        $client->delete();
        $this->menu->text('Profile deactivated successfully');
        $this->menu->lineBreak();
        $this->menu->paginateListing([
            'Home'], 1, 2, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $this->decision->equal('1', Welcome::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
