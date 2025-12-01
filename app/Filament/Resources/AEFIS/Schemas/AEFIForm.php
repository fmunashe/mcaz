<?php

namespace App\Filament\Resources\AEFIS\Schemas;

use App\OTPGeneration;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AEFIForm
{
    use OTPGeneration;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'full_name')
                    ->searchable()
                    ->preload(),
                TextInput::make('mcaz_reference_number')
                    ->default(self::generateReferenceNumber()),
                TextInput::make('patient_name')
                    ->required(),
                TextInput::make('patient_full_address'),
                TextInput::make('telephone')
                    ->tel(),
                Select::make('gender_id')
                    ->relationship('gender', 'gender')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('pregnancy_status')
                    ->options(['pregnant' => 'Pregnant', 'lactating' => 'Lactating', 'not_pregnant' => 'Not pregnant'])
                    ->default('not_pregnant')
                    ->searchable()
                    ->preload(),
                DatePicker::make('dob'),
                TextInput::make('age'),
                TextInput::make('reported_by'),
                Select::make('designation')
                    ->options([
                        'Physician',
                        'Pharmacist',
                        'Nurse',
                        'Other health professional',
                        'Lawyer',
                        'Consumer or other non-health professional'
                    ])
                    ->searchable()
                    ->preload(),
                TextInput::make('address'),
                TextInput::make('phone_number')
                    ->tel(),
                TextInput::make('email_address')
                    ->email(),
                TextInput::make('institution'),
                DatePicker::make('date_of_event_notification'),
                TextInput::make('health_facility_name'),
                DatePicker::make('date_aefi_started'),
                Select::make('serious')
                    ->options(['Yes' => 'Yes', 'No' => 'No'])
                    ->default('Yes')
                    ->searchable()
                    ->preload(),
                Select::make('a_d_r_outcome_id')
                    ->label('Outcome')
                    ->relationship('aDROutcome', 'outcome')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('age_group_id')
                    ->relationship('ageGroup', 'age_group')
                    ->searchable()
                    ->preload(),
                DatePicker::make('date_of_death'),
                Select::make('autopsy_done')
                    ->options(['Yes' => 'Yes', 'No' => 'No', 'Unknown' => 'Unknown'])
                    ->default('Unknown')
                    ->searchable()
                    ->preload(),
                Select::make('investigation_needed')
                    ->options(['Yes' => 'Yes', 'No' => 'No'])
                    ->default('No')
                    ->searchable()
                    ->preload(),
                DatePicker::make('date_investigation_planned'),
                DatePicker::make('date_report_received_at_national_level'),
                TextInput::make('aefi_worldwide_unique_id'),
                TextInput::make('status'),
                TextInput::make('comments'),
            ]);
    }
}
