<?php

namespace App\Filament\Resources\ProductDefects\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NatureOfDefectsRelationManager extends RelationManager
{
    protected static string $relationship = 'natureOfDefects';
    
    protected static ?string $title = 'Nature of Defects';
    
    protected static ?string $modelLabel = 'Nature of Defect';
    
    protected static ?string $pluralModelLabel = 'Nature of Defects';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('defect_id')
                    ->label('Defect')
                    ->relationship('defect', 'defect')
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('comments')
                    ->label('Comments')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('defect.defect')
                    ->label('Defect'),
                TextEntry::make('comments')
                    ->label('Comments')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('defect.defect')
            ->columns([
                TextColumn::make('defect.defect')
                    ->label('Defect')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('comments')
                    ->label('Comments')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['product_defect_id'] = $this->ownerRecord->getKey();
                        return $data;
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
