<?php

namespace App\Http\Ussd\States\MySubmissions;

use App\Models\AEFI;
use Sparors\Ussd\State;

class AefiFollowupInformation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter the followup information for the AEFI with reference ' . $this->record->get('aefiFollowupReference'));
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('aefiFollowupInformation', $argument);


        $aefi= AEFI::query()->where('mcaz_reference_number', $this->record->get('aefiFollowupReference'))->first();

        if ($aefi) {
            \App\Models\AEFIFollowupInformation::create([
                'a_e_f_i_id' => $aefi->id,
                'followup_information' => $this->record->get('aefiFollowupInformation'),
            ]);
            $this->decision->any(AefiFollowupInformationSuccessful::class);
        }else{
            $this->decision->any(AefiFollowupInformationFail::class);
        }

        $this->decision->any(AefiFollowupInformationSuccessful::class);
    }
}
