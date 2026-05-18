<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class ItemDistributionChart extends ChartWidget
{
    use HasWidgetShield;
    protected ?string $heading = 'Persenan Distribusi Barang';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Persenan Distribusi Barang',
                    'data' => Item::selectRaw('ROUND(quantity * 100.0 / SUM(quantity) OVER(), 2) as percentage')->get()->pluck('percentage'),
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                ],
            ],
            'labels' => Item::all()->pluck('name')
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
