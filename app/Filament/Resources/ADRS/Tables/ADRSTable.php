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
                TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                TextColumn::make('client.id')
                    ->searchable(),
                TextColumn::make('mcaz_reference_number')
                    ->searchable(),
                TextColumn::make('hospital_name')
                    ->searchable(),
                TextColumn::make('hospital_number')
                    ->searchable(),
                TextColumn::make('patient_initials')
                    ->searchable(),
                TextColumn::make('vct_or_tb_number')
                    ->searchable(),
                TextColumn::make('dob')
                    ->searchable(),
                TextColumn::make('weight')
                    ->searchable(),
                TextColumn::make('height')
                    ->searchable(),
                TextColumn::make('age')
                    ->searchable(),
                TextColumn::make('gender.id')
                    ->searchable(),
                TextColumn::make('reported_by')
                    ->searchable(),
                TextColumn::make('designation')
                    ->searchable(),
                TextColumn::make('email_address')
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->searchable(),
                TextColumn::make('institution_name')
                    ->searchable(),
                TextColumn::make('institution_address')
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
