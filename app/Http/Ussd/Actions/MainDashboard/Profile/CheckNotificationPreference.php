<?php

namespace App\Http\Ussd\Actions\MainDashboard\Profile;

use App\Http\Ussd\States\MainDashboard\Profile\NotificationPreferenceSetSuccessfully;
use App\UssdLoggedInUser;
use Sparors\Ussd\Action;

class CheckNotificationPreference extends Action
{
    use UssdLoggedInUser;

    public function run(): string
    {
        $notificationPreference = $this->record->get('notificationPreference');
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));

        if ($notificationPreference == '1') {
            $client->notify_via = 'sms';
        } else {
            $client->notify_via = 'email';
        }
        $client->save();

        return NotificationPreferenceSetSuccessfully::class;
    }
}
