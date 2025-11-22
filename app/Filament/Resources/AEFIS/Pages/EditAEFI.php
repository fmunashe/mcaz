<?php

namespace App\Filament\Resources\AEFIS\Pages;

use App\Filament\Resources\AEFIS\AEFIResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAEFI extends EditRecord
{
    protected static string $resource = AEFIResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
