<?php

namespace App\Filament\Resources\ADRS\Schemas;

use App\OTPGeneration;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ADRForm
{
    use OTPGeneration;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'full_name')
                    ->searchable()
                    ->preload(),
                TextInput::make('mcaz_reference_number')
                    ->default(fn() => self::generateReferenceNumber())
                    ->readonly()
                    ->dehydrated(),
                TextInput::make('hospital_name')
                    ->required(),
                TextInput::make('hospital_number')
                    ->required(),
                TextInput::make('patient_initials')
                    ->required(),
                TextInput::make('vct_or_tb_number')
                    ->required(),
                DatePicker::make('dob')
                    ->required(),
                TextInput::make('weight')
                    ->numeric()
                    ->required(),
                TextInput::make('height')
                    ->numeric()
                    ->required(),
                TextInput::make('age')
                    ->numeric()
                    ->required(),
                Select::make('gender_id')
                    ->required()
                    ->label('Sex')
                    ->relationship('gender', 'gender')
                    ->searchable()
                    ->preload(),
                TextInput::make('reported_by')
                    ->required()
                    ->default(auth()->user()->name),
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
                    ->preload()
                ->required(),
                TextInput::make('email_address')
                    ->email()
                    ->required(),
                TextInput::make('phone_number')
                    ->numeric()
                    ->required(),
                TextInput::make('institution_name')
                    ->required(),
                TextInput::make('institution_address')
                    ->required(),
                TextInput::make('status'),
            ])->columns(3);
    }
}
