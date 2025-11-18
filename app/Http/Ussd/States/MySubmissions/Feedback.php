<?php

namespace App\Http\Ussd\States\MySubmissions;

use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class Feedback extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        $client = $this->getUserByPhone($this->record->get('phoneNumber'));
        if ($this->record->get('isLoggedIn')) {
            if ($client) {
                $complaints = \App\Models\CustomerComplaint::where('client_id', $client->id)->get();
                $adrs = \App\Models\ADR::where('client_id', $client->id)->get();
                $aefis = \App\Models\AEFI::where('client_id', $client->id)->get();
                $defects = \App\Models\ProductDefect::where('client_id', $client->id)->get();
                $message = '';
                foreach ($complaints as $index => $complaint) {
                    $message = $message . ($index + 1) . '. ' . $complaint->complaint_number . ' -- ' . $complaint->status . '\n';
                }
                foreach ($adrs as $index => $adr) {
                    $message = $message . ($index + 1) . '. ' . $adr->mcaz_reference_number . ' -- ' . $adr->status . '\n';
                }
                foreach ($aefis as $index => $aefi) {
                    $message = $message . ($index + 1) . '. ' . $aefi->mcaz_reference_number . ' -- ' . $aefi->status . '\n';
                }
                foreach ($defects as $index => $defect) {
                    $message = $message . ($index + 1) . '. ' . $defect->report_number . ' -- ' . $defect->status . '\n';
                }

                $this->menu->line('Hello ' . $client->full_name);
                $this->menu->line('Here are your complaints submissions');
                $this->menu->line($message);
                $this->menu->paginateListing([
                    'Back'
                ], 1, 2, '. ');
            }
        } else {
            $this->menu->line('You are not logged in');
            $this->menu->line('Please login or register to view your submissions');
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
        if ($this->record->get('isLoggedIn')) {
            $this->decision->equal('1', MySubmissions::class);
        } else {
            $this->decision->equal('1', MySubmissions::class);
        }

    }
}
