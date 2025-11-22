<?php

namespace App\Filament\Resources\AEFIS\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AEFIForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'id'),
                TextInput::make('mcaz_reference_number'),
                TextInput::make('patient_name'),
                TextInput::make('patient_full_address'),
                TextInput::make('telephone')
                    ->tel(),
                TextInput::make('gender_id'),
                Select::make('pregnancy_status')
                    ->options(['pregnant' => 'Pregnant', 'lactating' => 'Lactating', 'not_pregnant' => 'Not pregnant']),
                TextInput::make('dob'),
                TextInput::make('age'),
                TextInput::make('reported_by'),
                Textarea::make('designation')
                    ->columnSpanFull(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('email_address')
                    ->email(),
                TextInput::make('institution'),
                TextInput::make('date_of_event_notification'),
                Textarea::make('health_facility_name')
                    ->columnSpanFull(),
                TextInput::make('date_aefi_started'),
                Select::make('serious')
                    ->options(['Yes' => 'Yes', 'No' => 'No'])
                    ->default('Yes')
                    ->required(),
                TextInput::make('a_d_r_outcome_id'),
                Select::make('age_group_id')
                    ->relationship('ageGroup', 'id'),
                TextInput::make('date_of_death'),
                Select::make('autopsy_done')
                    ->options(['Yes' => 'Yes', 'No' => 'No', 'Unknown' => 'Unknown'])
                    ->default('Unknown'),
                Select::make('investigation_needed')
                    ->options(['Yes' => 'Yes', 'No' => 'No'])
                    ->default('No'),
                TextInput::make('date_investigation_planned'),
                TextInput::make('date_report_received_at_national_level'),
                TextInput::make('aefi_worldwide_unique_id'),
                Textarea::make('comments')
                    ->columnSpanFull(),
                Textarea::make('status')
                    ->columnSpanFull(),
            ]);
    }
}
