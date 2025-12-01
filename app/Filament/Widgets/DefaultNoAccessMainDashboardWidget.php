<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DefaultNoAccessMainDashboardWidget extends BaseWidget
{

    protected int|string|array $columnSpan = 12;

    protected function getStats(): array
    {
        return [
            Stat::make('', null)
                ->chart([70, 2, 30, 3, 15, 4, 17,500])
                ->description('Request access from your administrator to view the dashboard information.')
                ->descriptionIcon('heroicon-m-key')
                ->color('danger')
        ];
    }

    public function getColumns(): int
    {
        return 1;
    }
}
