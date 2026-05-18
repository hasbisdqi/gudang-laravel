<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class ItemCategoryChart extends ChartWidget
{
    use HasWidgetShield;
    protected ?string $heading = 'Jumlah Kategori Barang';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Unit',
                    'data' => Item::limit(5)->get()->pluck('quantity') 
                ],
            ],
            'labels' => Item::limit(5)->get()->pluck('name') 

        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
