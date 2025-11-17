<?php

namespace App\Http\Ussd\States\MainDashboard\ADR\CurrentMedications;

use Illuminate\Support\Str;
use Sparors\Ussd\State;

class DateStarted extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter valid current medication date started '.$this->record->get('medicationCount').' format ddmmyyyy eg 01012022');
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
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
        $currentCount = $this->record->get('medicationCount');
        $this->record->set('dateStarted'.$currentCount, $formattedDate);
        $this->decision->any(DateStopped::class);
    }
}
