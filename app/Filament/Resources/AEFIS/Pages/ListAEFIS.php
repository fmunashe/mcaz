<?php

namespace App\Filament\Resources\AEFIS\Pages;

use App\Filament\Resources\AEFIS\AEFIResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAEFIS extends ListRecords
{
    protected static string $resource = AEFIResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
