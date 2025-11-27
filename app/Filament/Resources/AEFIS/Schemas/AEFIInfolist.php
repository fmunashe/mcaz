<?php

namespace App\Filament\Resources\AEFIS\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AEFIInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('client.full_name')
                    ->label('Client')
                    ->placeholder('-'),
                TextEntry::make('mcaz_reference_number')
                    ->placeholder('-'),
                TextEntry::make('patient_name')
                    ->placeholder('-'),
                TextEntry::make('patient_full_address')
                    ->placeholder('-'),
                TextEntry::make('telephone')
                    ->placeholder('-'),
                TextEntry::make('gender_id')
                    ->placeholder('-'),
                TextEntry::make('pregnancy_status')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('dob')
                    ->placeholder('-'),
                TextEntry::make('age')
                    ->placeholder('-'),
                TextEntry::make('reported_by')
                    ->placeholder('-'),
                TextEntry::make('designation')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('address')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('phone_number')
                    ->placeholder('-'),
                TextEntry::make('email_address')
                    ->placeholder('-'),
                TextEntry::make('institution')
                    ->placeholder('-'),
                TextEntry::make('date_of_event_notification')
                    ->placeholder('-'),
                TextEntry::make('health_facility_name')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('date_aefi_started')
                    ->placeholder('-'),
                TextEntry::make('serious')
                    ->badge(),
                TextEntry::make('a_d_r_outcome_id')
                    ->placeholder('-'),
                TextEntry::make('ageGroup.age_group')
                    ->label('Age group')
                    ->placeholder('-'),
                TextEntry::make('date_of_death')
                    ->placeholder('-'),
                TextEntry::make('autopsy_done')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('investigation_needed')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('date_investigation_planned')
                    ->placeholder('-'),
                TextEntry::make('date_report_received_at_national_level')
                    ->placeholder('-'),
                TextEntry::make('aefi_worldwide_unique_id')
                    ->placeholder('-'),
                TextEntry::make('comments')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->placeholder('-')
                    ->columnSpanFull()
            ]);
    }
}
