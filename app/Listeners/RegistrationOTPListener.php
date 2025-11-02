<?php

namespace App\Listeners;

use App\Events\RegistrationOTPEvent;
use App\Notifications\SendRegistrationOTPViaEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class RegistrationOTPListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(RegistrationOTPEvent $event): void
    {
        Notification::route('mail', $event->notificationData->email)
            ->notify(new SendRegistrationOTPViaEmail($event->notificationData));


//            $member->notify(new SendRegistrationOTPViaSMS($event->notificationData));
//            $member->notify(new SendRegistrationOTPViaEmail($event->notificationData));


    }
}
