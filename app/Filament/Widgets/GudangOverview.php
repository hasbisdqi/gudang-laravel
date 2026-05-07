<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GudangOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Jenis Item', Item::count('id'))
                ->icon(Heroicon::ArchiveBox)
                ->description('21% increase since last week'),
            Stat::make('Jumlah PCS Barang', Item::sum('quantity'))
                ->icon(Heroicon::ChartBar)
                ->description('5% increase since last week'),
            Stat::make('Jumlah Akun', User::count('id'))
                ->icon(Heroicon::Clock)
                ->description('2% decrease since last week'),
        ];
    }
}
