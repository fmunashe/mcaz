<?php

namespace App\Http\Ussd\Actions;

use App\Http\Ussd\States\MainDashboard\Dashboard;
use App\Http\Ussd\States\Welcome;
use Sparors\Ussd\Action;

class CheckLoggedIn extends Action
{
    public function run(): string
    {
        $isLoggedIn = $this->record->get('isLoggedIn');
        if ($isLoggedIn) {
            return Dashboard::class;
        }
        return Welcome::class;
    }
}
