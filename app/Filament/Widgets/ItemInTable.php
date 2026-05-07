<?php

namespace App\Filament\Widgets;

use App\Models\ItemTransaction;
use App\TransactionType;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ItemInTable extends TableWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => ItemTransaction::query()->where('transaction_type',TransactionType::INCOMING))
            ->columns([
                TextColumn::make('item_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('change_in_quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
