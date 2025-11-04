<?php

namespace App\Notifications;

use App\Http\common\OTPNotificationData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PinResetNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public OTPNotificationData $notificationData;

    public function __construct(OTPNotificationData $notificationData)
    {
        $this->notificationData = $notificationData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mailMessage = (new MailMessage)
            ->greeting('Dear '.$this->notificationData->name)
            ->subject('MCAZ Pin Reset OTP')
            ->line('You have requested for a pin reset and below is your OTP')
            ->line($this->notificationData->otp)
            ->line('This OTP is valid for 5 minutes')
            ->line('Please ignore this message if you did not initiate this request');

        return $mailMessage->line('Thank you for using our application!');
    }

}
