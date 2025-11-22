<?php

namespace App\Filament\Resources\ProductDefects\Pages;

use App\Filament\Resources\ProductDefects\ProductDefectResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProductDefect extends ViewRecord
{
    protected static string $resource = ProductDefectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
