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
        $stats = [
            Stat::make('Jumlah Jenis Item', Item::count('id'))
                ->icon(Heroicon::ArchiveBox)
                ->description('21% increase since last week'),

            Stat::make('Jumlah PCS Barang', Item::sum('quantity'))
                ->icon(Heroicon::ChartBar)
                ->description('5% increase since last week'),
        ];

        if (auth()->user()->hasRole(['admin', 'super_admin'])) {
            $stats[] = Stat::make('Jumlah Akun', User::count('id'))
                ->icon(Heroicon::Users)
                ->description('2% decrease since last week');
        } else {
            $stats[] = Stat::make('Jumlah Barang Habis', Item::where('quantity', 0)->count())
                ->icon(Heroicon::ExclamationTriangle)
                ->description('Barang dengan stok kosong');
        }

        return $stats;
    }
}
