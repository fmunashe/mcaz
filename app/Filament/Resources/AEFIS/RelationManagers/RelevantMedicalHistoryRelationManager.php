<?php

namespace App\Filament\Resources\AEFIS\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RelevantMedicalHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'relevantMedicalHistory';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('relevant_medical_history')
                    ->columnSpanFull(),
                Textarea::make('lab_test_results')
                    ->columnSpanFull(),
                Select::make('action_taken_id')
                    ->relationship('actionTaken', 'action_taken'),
                Select::make('a_d_r_outcome_id')
                    ->relationship('a_d_r_outcome', 'outcome'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('relevant_medical_history')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('lab_test_results')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('actionTaken.action_taken')
                    ->label('Action taken')
                    ->placeholder('-'),
                TextEntry::make('a_d_r_outcome.outcome')
                    ->label('Outcome')
                    ->placeholder('-')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('a_e_f_i_id')
            ->columns([
                TextColumn::make('relevant_medical_history')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('lab_test_results')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('actionTaken.action_taken')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('a_d_r_outcome.outcome')
                    ->label('Outcome')
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
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
