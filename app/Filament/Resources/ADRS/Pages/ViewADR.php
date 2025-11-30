<?php

namespace App\Filament\Resources\ADRS\Pages;

use App\Filament\Resources\ADRS\ADRResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewADR extends ViewRecord
{
    protected static string $resource = ADRResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function hasCombinedRelationManagerTabsWithContent(): bool
    {
        return false;
    }
}
