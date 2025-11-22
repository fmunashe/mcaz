<?php

namespace App\Filament\Resources\ProductDefects\Pages;

use App\Filament\Resources\ProductDefects\ProductDefectResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProductDefect extends EditRecord
{
    protected static string $resource = ProductDefectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
