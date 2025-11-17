<?php

namespace App\Http\Ussd\States\MySubmissions;

use App\Http\Ussd\States\GuestMenu\ContinueWithoutRegistering;
use App\Http\Ussd\States\MainDashboard\Dashboard;
use Sparors\Ussd\State;

class MySubmissions extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('My Submissions');
        $this->menu->paginateListing([
            'View All',
            'Feedback',
            'Add FollowUp information for previously submitted reports',
            'Reports',
            'Back'], 1, 5, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || !in_array($argument, [1, 2, 3, 4, 5])) {
            $this->decision->any(self::class);
            return;
        }
        if ($argument == 5) {
            if ($this->record->get('isLoggedIn')) {
                $this->decision->equal('5', Dashboard::class);
            } else {
                $this->decision->equal('5', ContinueWithoutRegistering::class);
            }
        }
        $this->decision->equal('1', ViewAll::class);
        $this->decision->equal('2', Feedback::class);
        $this->decision->equal('3', AddFollowupInformation::class);
        $this->decision->equal('4', Reports::class);

        $this->decision->any(MySubmissions::class);
    }
}
