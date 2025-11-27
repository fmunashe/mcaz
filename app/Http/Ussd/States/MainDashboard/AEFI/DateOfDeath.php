<?php

namespace App\Http\Ussd\States\MainDashboard\AEFI;

use Illuminate\Support\Str;
use Sparors\Ussd\State;

class DateOfDeath extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Date of death format ddmmyyyy e.g 01012020');
    }

    protected function afterRendering(string $argument): void
    {
        if (Str::length($argument) != 8) {
            $this->decision->any(self::class);
            return;
        }

        // Convert ddmmyyyy format to Y-m-d format
        $day = substr($argument, 0, 2);
        $month = substr($argument, 2, 2);
        $year = substr($argument, 4, 4);

        if ($month > 12) {
            $this->decision->any(self::class);
            return;
        }

        // Validate the date
        if (!checkdate($month, $day, $year)) {
            $this->decision->any(self::class);
            return;
        }
        $formattedDate = $year . '-' . $month . '-' . $day;
        $this->record->set('dateOfDeath', $formattedDate);
        $this->decision->any(AutopsyDone::class);
    }
}
