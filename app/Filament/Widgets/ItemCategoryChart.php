<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Widgets\ChartWidget;

class ItemCategoryChart extends ChartWidget
{
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
