<?php

namespace App\Http\Ussd\States\MainDashboard\Profile;

use App\Http\Ussd\Actions\MainDashboard\Profile\CheckNotificationPreference;
use App\Http\Ussd\States\InvalidMenuSelection;
use Sparors\Ussd\State;

class NotificationPreference extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Notification preference');
        $this->menu->paginateListing([
            'SMS',
            'Email',
            'Back'], 1, 3, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        $notificationPreference = $argument;
        $this->record->set('notificationPreference', $notificationPreference);
        $this->decision->in(['1', '2'], CheckNotificationPreference::class);
        $this->decision->equal('3', MyProfile::class);
        $this->decision->any(InvalidMenuSelection::class);
    }
}
