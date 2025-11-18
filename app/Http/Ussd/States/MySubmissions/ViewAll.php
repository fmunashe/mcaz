<?php

namespace App\Http\Ussd\States\MySubmissions;

use App\Http\Ussd\States\ExitState;
use App\Http\Ussd\States\MySubmissions\ViewAll\Complaints;
use App\Http\Ussd\States\MySubmissions\ViewAll\ViewAdrReport;
use App\Http\Ussd\States\MySubmissions\ViewAll\ViewAefiReport;
use App\Http\Ussd\States\MySubmissions\ViewAll\ViewQualityProblemReport;
use App\UssdLoggedInUser;
use Sparors\Ussd\State;

class ViewAll extends State
{
    use UssdLoggedInUser;

    protected function beforeRendering(): void
    {
        if ($this->record->get('isLoggedIn')) {
            $client = $this->getUserByPhone($this->record->get('phoneNumber'));
            if ($client) {
                $this->menu->line('Hello ' . $client->full_name);
                $this->menu->line('Your submissions');
                $this->menu->paginateListing([
                    'Complaints',
                    'AEFI',
                    'ADR',
                    'Quality Problem Report',
                    'Back'
                ], 1, 5, '. ');
            }
        } else {
            $this->menu->line('You are not logged in');
            $this->menu->line('Please login or register to view your submissions');
            $this->menu->paginateListing([
                'Main Menu',
                'Back'
            ], 1, 2, '. ');
        }

    }

    protected function afterRendering(string $argument): void
    {
        if ($this->record->get('isLoggedIn')) {
            $client = $this->getUserByPhone($this->record->get('phoneNumber'));
            if ($client) {
                $this->decision->equal('1', Complaints::class);
                $this->decision->equal('2', ViewAefiReport::class);
                $this->decision->equal('3', ViewAdrReport::class);
                $this->decision->equal('4', ViewQualityProblemReport::class);
                $this->decision->equal('5', MySubmissions::class);
                $this->decision->any(Complaints::class);
            }
        } else {
            $this->decision->equal('1', ExitState::class);
            $this->decision->equal('2', MySubmissions::class);
            $this->decision->any(ExitState::class);
        }
    }
}
