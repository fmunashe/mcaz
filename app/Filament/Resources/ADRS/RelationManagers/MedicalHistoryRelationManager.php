<?php

namespace App\Filament\Resources\ADRS\RelationManagers;

use App\Filament\Exports\RelevantMedicalHistoryExporter;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MedicalHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'medicalHistory';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('relevant_medical_history')
                    ->columnSpanFull(),
                Textarea::make('lab_test_results')
                    ->columnSpanFull(),
                Select::make('action_taken_id')
                    ->relationship('actionTaken', 'action_taken')
                    ->searchable()
                    ->preload(),
                Select::make('a_d_r_outcome_id')
                    ->relationship('a_d_r_outcome', 'outcome')
                    ->searchable()
                    ->preload(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->inlineLabel()
            ->components([
                TextEntry::make('relevant_medical_history')
                    ->placeholder('-'),
                TextEntry::make('lab_test_results')
                    ->placeholder('-'),
                TextEntry::make('actionTaken.action_taken')
                    ->placeholder('-'),
                TextEntry::make('a_d_r_outcome.outcome')
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('a_d_r_id')
            ->columns([
                TextColumn::make('relevant_medical_history')
                    ->label('Medical History')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('lab_test_results')
                    ->label('Lab Test Results')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('actionTaken.action_taken')
                    ->label('Action Taken')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('a_d_r_outcome.outcome')
                    ->label('Outcome')
                    ->searchable()
                    ->sortable()
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
                ExportAction::make()
                    ->exporter(RelevantMedicalHistoryExporter::class)
                    ->columnMappingColumns(3)
                    ->formats([
                        ExportFormat::Xlsx,
                        ExportFormat::Csv,
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(RelevantMedicalHistoryExporter::class)
                        ->columnMappingColumns(3)
                        ->formats([
                            ExportFormat::Xlsx,
                            ExportFormat::Csv,
                        ]),
                ]),
            ]);
    }
}
