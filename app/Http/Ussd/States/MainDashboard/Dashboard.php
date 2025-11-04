<?php

namespace App\Http\Ussd\States\MainDashboard;

use Sparors\Ussd\State;

class Dashboard extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->text('Welcome to the dashboard');
        $this->menu->lineBreak(2);
        $this->menu->paginateListing([
            'Report suspected reaction with a medicine (ADR)',
            'Report suspected reaction with a vaccine (AEFI)',
            'Report suspected quality problem with a medicine/vaccine/glove/condom',
            'Submit a complaint',
            'FAQs',
            'Make an enquiry',
            'My submissions',
            'Notifications',
            'My Profile',
            'Help',
            'Exit'], 1, 15, '. ');
    }

    protected function afterRendering(string $argument): void
    {
        //
    }
}
