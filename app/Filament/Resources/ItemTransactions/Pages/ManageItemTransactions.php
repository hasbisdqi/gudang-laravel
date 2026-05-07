<?php

namespace App\Filament\Resources\ItemTransactions\Pages;

use App\Filament\Exports\ItemTransactionExporter;
use App\Filament\Resources\ItemTransactions\ItemTransactionResource;
use App\Models\Item;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageItemTransactions extends ManageRecords
{
    protected static string $resource = ItemTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(ItemTransactionExporter::class),
            CreateAction::make()
                ->mutateDataUsing(function ($data) {
                    $data['user_id'] = Auth::id();
                    return $data;
                })
                ->after(function ($record) {

                    $record->item->adjustStock(
                        $record->transaction_type,
                        $record->change_in_quantity
                    );
                }),
        ];
    }
}
