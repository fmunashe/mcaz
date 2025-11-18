<?php

namespace App\Http\Ussd\States\MySubmissions\ViewAll;

use App\Http\Ussd\States\MySubmissions\ViewAll;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class Complaints extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));
        if ($client) {
            $complaints = \App\Models\CustomerComplaint::where('client_id', $client->id)->pluck('complaint_number')->toArray();
            $message = '';
            foreach ($complaints as $index => $complaint) {
                $message = $message . ($index + 1) . '. ' . $complaint . '\n';
            }

            $this->menu->line('Hello ' . $client->full_name);
            $this->menu->line('Here are your complaints submissions');
            $this->menu->line($message);
            $this->menu->paginateListing([
                'Back'
            ], 1, 2, '. ');
        }
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument) || $argument != 1) {
            $this->decision->any(self::class);
            return;
        }
        $this->decision->equal('1', ViewAll::class);
    }
}
