<?php

namespace App\Filament\Resources\AEFIS\Pages;

use App\Filament\Resources\AEFIS\AEFIResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAEFI extends ViewRecord
{
    protected static string $resource = AEFIResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
