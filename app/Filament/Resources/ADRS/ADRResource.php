<?php

namespace App\Filament\Resources\ADRS;

use App\Filament\Resources\ADRS\Pages\CreateADR;
use App\Filament\Resources\ADRS\Pages\EditADR;
use App\Filament\Resources\ADRS\Pages\ListADRS;
use App\Filament\Resources\ADRS\Pages\ViewADR;
use App\Filament\Resources\ADRS\Schemas\ADRForm;
use App\Filament\Resources\ADRS\Schemas\ADRInfolist;
use App\Filament\Resources\ADRS\Tables\ADRSTable;
use App\Models\ADR;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ADRResource extends Resource
{
    protected static ?string $model = ADR::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Heart;

    protected static ?string $recordTitleAttribute = 'Adverse Drug Reactions';
    protected static ?string $navigationLabel = 'ADR';
    protected static ?string $modelLabel = 'ADR';
    protected static ?string $pluralModelLabel = 'ADRs';

    public static function form(Schema $schema): Schema
    {
        return ADRForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ADRInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ADRSTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListADRS::route('/'),
            'create' => CreateADR::route('/create'),
            'view' => ViewADR::route('/{record}'),
            'edit' => EditADR::route('/{record}/edit'),
        ];
    }
}
