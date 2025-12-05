<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class RegisteredClientsByLanguageChart extends ApexChartWidget
{
    protected static ?string $chartId = 'registeredClientsByGenderChart';

    protected static ?string $heading = 'Registered Clients By Language';

    protected static bool $isCollapsible = true;
    protected int|string|array $columnSpan = 12;

    protected function getOptions(): array
    {
        $results = Client::query()
            ->join('languages', 'clients.language_id', '=', 'languages.id')
            ->selectRaw('COUNT(*) as value, languages.name as language')
            ->groupBy('language')
            ->get();


        $labels = $results->pluck('language')->toArray();
//        $data = $results->pluck('value')->toArray();
        $data = $results->pluck('value')
            ->map(fn ($v) => (int) $v)
            ->toArray();
        return [
            'chart' => [
                'type' => 'donut',
                'height' => 200,
            ],
            'series' => $data,
            'labels' => $labels,
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
    public function getColumns(): int
    {
        return 1;
    }

}
