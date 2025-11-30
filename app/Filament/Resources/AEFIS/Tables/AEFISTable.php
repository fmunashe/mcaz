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
                TextColumn::make('client.full_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('mcaz_reference_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('patient_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('patient_full_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('telephone')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('gender.gender')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('pregnancy_status')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('dob')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('age')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('reported_by')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('institution')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_of_event_notification')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_aefi_started')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('serious')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('a_d_r_outcome_id')
                    ->label('Outcome')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('ageGroup.age_group')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_of_death')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('autopsy_done')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('investigation_needed')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('date_investigation_planned')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('date_report_received_at_national_level')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('aefi_worldwide_unique_id')
                    ->searchable()
                    ->toggleable(),
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
