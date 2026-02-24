<?php

namespace App\Filament\Resources\ItemTransactions\Pages;

use App\Filament\Resources\ItemTransactions\ItemTransactionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Auth;

class ManageItemTransactions extends ManageRecords
{
    protected static string $resource = ItemTransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateDataUsing(function (array $data): array {
                    $data['user_id'] = Auth::id();
                    return $data;
                }),
        ];
    }
}
