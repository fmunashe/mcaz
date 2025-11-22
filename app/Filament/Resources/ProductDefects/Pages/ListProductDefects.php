<?php

namespace App\Filament\Resources\ProductDefects\Pages;

use App\Filament\Resources\ProductDefects\ProductDefectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductDefects extends ListRecords
{
    protected static string $resource = ProductDefectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
