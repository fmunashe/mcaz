<?php

namespace App\Filament\Resources\ADRS\Pages;

use App\Filament\Resources\ADRS\ADRResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListADRS extends ListRecords
{
    protected static string $resource = ADRResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
