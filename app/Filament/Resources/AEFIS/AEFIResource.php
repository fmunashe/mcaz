<?php

namespace App\Filament\Resources\AEFIS;

use App\Filament\Resources\AEFIS\Pages\CreateAEFI;
use App\Filament\Resources\AEFIS\Pages\EditAEFI;
use App\Filament\Resources\AEFIS\Pages\ListAEFIS;
use App\Filament\Resources\AEFIS\Pages\ViewAEFI;
use App\Filament\Resources\AEFIS\Schemas\AEFIForm;
use App\Filament\Resources\AEFIS\Schemas\AEFIInfolist;
use App\Filament\Resources\AEFIS\Tables\AEFISTable;
use App\Models\AEFI;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AEFIResource extends Resource
{
    protected static ?string $model = AEFI::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::PlusCircle;

    protected static ?string $recordTitleAttribute = 'Adverse Events Following Immunisation';
    protected static ?string $navigationLabel = 'Adverse Events Following Immunisation';
    protected static ?string $modelLabel = 'Adverse Event Following Immunisation';
    protected static ?string $pluralModelLabel = 'Adverse Events Following Immunisation';

    public static function form(Schema $schema): Schema
    {
        return AEFIForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AEFIInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AEFISTable::configure($table);
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
            'index' => ListAEFIS::route('/'),
            'create' => CreateAEFI::route('/create'),
            'view' => ViewAEFI::route('/{record}'),
            'edit' => EditAEFI::route('/{record}/edit'),
        ];
    }
}
