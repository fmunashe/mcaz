<?php

namespace App\Filament\Resources\AEFIS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AEFISTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('client.id')
                    ->searchable(),
                TextColumn::make('mcaz_reference_number')
                    ->searchable(),
                TextColumn::make('patient_name')
                    ->searchable(),
                TextColumn::make('patient_full_address')
                    ->searchable(),
                TextColumn::make('telephone')
                    ->searchable(),
                TextColumn::make('gender_id')
                    ->searchable(),
                TextColumn::make('pregnancy_status')
                    ->badge(),
                TextColumn::make('dob')
                    ->searchable(),
                TextColumn::make('age')
                    ->searchable(),
                TextColumn::make('reported_by')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->searchable(),
                TextColumn::make('email_address')
                    ->searchable(),
                TextColumn::make('institution')
                    ->searchable(),
                TextColumn::make('date_of_event_notification')
                    ->searchable(),
                TextColumn::make('date_aefi_started')
                    ->searchable(),
                TextColumn::make('serious')
                    ->badge(),
                TextColumn::make('a_d_r_outcome_id')
                    ->searchable(),
                TextColumn::make('ageGroup.id')
                    ->searchable(),
                TextColumn::make('date_of_death')
                    ->searchable(),
                TextColumn::make('autopsy_done')
                    ->badge(),
                TextColumn::make('investigation_needed')
                    ->badge(),
                TextColumn::make('date_investigation_planned')
                    ->searchable(),
                TextColumn::make('date_report_received_at_national_level')
                    ->searchable(),
                TextColumn::make('aefi_worldwide_unique_id')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
