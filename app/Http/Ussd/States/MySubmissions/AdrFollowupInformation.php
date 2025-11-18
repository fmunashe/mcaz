<?php

namespace App\Http\Ussd\States\MySubmissions;

use App\Models\ADR;
use Sparors\Ussd\State;

class AdrFollowupInformation extends State
{
    protected function beforeRendering(): void
    {
        $this->menu->line('Enter the followup information for the ADR with reference ' . $this->record->get('adrFollowupReference'));
    }

    protected function afterRendering(string $argument): void
    {
        if (empty($argument)) {
            $this->decision->any(self::class);
            return;
        }
        $this->record->set('adrFollowupInformation', $argument);

        $adr= ADR::query()->where('mcaz_reference_number', $this->record->get('adrFollowupReference'))->first();

        if ($adr) {
            \App\Models\ADRFollowupInformation::create([
                'a_d_r_id' => $adr->id,
                'followup_information' => $this->record->get('adrFollowupInformation'),
            ]);
            $this->decision->any(AdrFollowupInformationSuccessful::class);
        }else{
            $this->decision->any(AdrFollowupInformationFail::class);
        }
    }
}
