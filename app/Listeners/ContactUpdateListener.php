<?php

namespace App\Listeners;

use App\Events\ContactUpdate;
use App\Notifications\UpdateContactNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class ContactUpdateListener implements ShouldQueue
{
    public function handle(ContactUpdate $event): void
    {
        Notification::route('mail', $event->notificationData->email)
            ->notify(new UpdateContactNotification($event->notificationData));
    }
}
