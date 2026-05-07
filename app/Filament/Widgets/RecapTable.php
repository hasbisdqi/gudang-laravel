<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use App\Models\ItemTransaction;
use App\TransactionType;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Override;

class RecapTable extends TableWidget
{

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    #[Override]
    public function getTableHeading(): string|Htmlable|null
    {
        return 'Rekap Transaksi Barang';
    }

    public function table(Table $table): Table
    {
        $month = request('tableFilters.month.value') ?? now()->month;
        $year = now()->year;

        return $table
            ->query(
                fn(): Builder => Item::query()
                    ->withSum([
                        'transactions as stock_in' => fn($query) =>
                        $query
                            ->where('transaction_type', TransactionType::INCOMING)
                            ->whereMonth('created_at', $month)
                    ], 'change_in_quantity')
                    ->withSum([
                        'transactions as stock_out' => fn($query) =>
                        $query
                            ->where('transaction_type', TransactionType::OUTGOING)
                            ->whereMonth('created_at', $month)
                    ], 'change_in_quantity')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Barang')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stock_in')
                    ->label('Barang Masuk')
                    ->numeric()
                    ->default(0),

                TextColumn::make('stock_out')
                    ->label('Barang Keluar')
                    ->numeric()
                    ->default(0),

                TextColumn::make('quantity')
                    ->label('Sisa Stok')
                    ->numeric(),
            ])
            ->filters([
                Filter::make('month')
                    ->schema([
                        Select::make('value')
                            ->label('Bulan')
                            ->options([
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ])
                            ->default(now()->month)
                    ])
            ]);
    }
}
