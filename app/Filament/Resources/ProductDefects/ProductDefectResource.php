<?php

namespace App\Filament\Resources\ProductDefects;

use App\Filament\Resources\ProductDefects\Pages\CreateProductDefect;
use App\Filament\Resources\ProductDefects\Pages\EditProductDefect;
use App\Filament\Resources\ProductDefects\Pages\ListProductDefects;
use App\Filament\Resources\ProductDefects\Pages\ViewProductDefect;
use App\Filament\Resources\ProductDefects\RelationManagers\NatureOfDefectsRelationManager;
use App\Filament\Resources\ProductDefects\Schemas\ProductDefectForm;
use App\Filament\Resources\ProductDefects\Schemas\ProductDefectInfolist;
use App\Filament\Resources\ProductDefects\Tables\ProductDefectsTable;
use App\Models\ProductDefect;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductDefectResource extends Resource
{
    protected static ?string $model = ProductDefect::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::XMark;

    protected static ?string $recordTitleAttribute = 'ProductDefect';

    public static function form(Schema $schema): Schema
    {
        return ProductDefectForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProductDefectInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductDefectsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            NatureOfDefectsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductDefects::route('/'),
            'create' => CreateProductDefect::route('/create'),
            'view' => ViewProductDefect::route('/{record}'),
            'edit' => EditProductDefect::route('/{record}/edit'),
        ];
    }
}
