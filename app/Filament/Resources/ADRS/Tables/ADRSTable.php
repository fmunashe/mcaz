<?php

namespace App\Filament\Resources\ADRS\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ADRSTable
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
                TextColumn::make('hospital_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('hospital_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('patient_initials')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('vct_or_tb_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('dob')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('weight')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('height')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('age')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('gender.id')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('reported_by')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('designation')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('email_address')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('institution_name')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('institution_address')
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
