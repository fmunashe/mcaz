<?php

namespace App\Listeners;

use App\Events\PinResetEvent;
use App\Notifications\PinResetNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PinResetListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(PinResetEvent $event): void
    {
        Notification::route('mail', $event->notificationData->email)
            ->notify(new PinResetNotification($event->notificationData));
    }
}
