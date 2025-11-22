<?php

namespace App\Filament\Resources\ProductDefects\Schemas;

use App\OTPGeneration;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductDefectForm
{
    use OTPGeneration;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->searchable()
                    ->preload(),
                TextInput::make('product_name'),
                Textarea::make('description'),
                Textarea::make('intended_use'),
                TextInput::make('type_of_container'),
                TextInput::make('registration_number'),
                TextInput::make('batch_number'),
                DateTimePicker::make('expiry_date'),
                TextInput::make('name_of_manufacturer'),
                TextInput::make('address_of_manufacturer'),
                TextInput::make('name_of_reporter'),
                TextInput::make('title_of_reporter'),
                TextInput::make('practice_location'),
                TextInput::make('practise_address'),
                TextInput::make('phone_number')
                    ->tel(),
                DateTimePicker::make('date_problem_observed'),
                Select::make('product_available_for_examination')
                    ->options(['Yes' => 'Yes', 'No' => 'No'])
                    ->default('Yes')
                    ->searchable(),
                TextInput::make('reporter_signature'),
                TextInput::make('report_number')
                    ->label('Report Number')
                    ->default(fn() => self::generateReferenceNumber())
                    ->readonly()
                    ->dehydrated(),

                Repeater::make('natureOfDefects')
                    ->label('Nature of Defects')
                    ->relationship()
                    ->compact()
                    ->schema([
                        Select::make('defect_id')
                            ->label('Defect')
                            ->relationship('defect', 'defect')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('comments')
                            ->label('Comments')
                            ->rows(3),
                    ])
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['defect_id'] ? 'Defect: ' . $state['defect_id'] : null)
                    ->addActionLabel('Add Nature of Defect')
                    ->columnSpanFull(),
            ]);
    }
}
