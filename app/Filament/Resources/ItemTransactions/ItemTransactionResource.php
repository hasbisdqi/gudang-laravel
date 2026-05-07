<?php

namespace App\Filament\Resources\ItemTransactions;

use App\Filament\Resources\ItemTransactions\Pages\ManageItemTransactions;
use App\Models\ItemTransaction;
use App\TransactionType;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemTransactionResource extends Resource
{
    protected static ?string $model = ItemTransaction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('item_id')
                    ->relationship('item', 'name')
                    ->reactive()
                    ->required(),
                TextInput::make('change_in_quantity')
                    ->required()
                    ->disabled(fn(?int $recordId) => $recordId !== null)
                    ->maxValue(fn($get) => $get('transaction_type') === TransactionType::OUTGOING ? $get('item.quantity') : 999999)
                    ->numeric(),
                Select::make('transaction_type')
                    ->options(TransactionType::class)
                    ->reactive()
                    ->required(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('item.name')
                    ->label('Nama Barang')
                    ->placeholder('-'),
                TextEntry::make('change_in_quantity')
                ->label('Jumlah')
                    ->numeric(),
                TextEntry::make('transaction_type'),
                TextEntry::make('user.name')
                    ->label('Nama Admin')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('item.name')
                    ->label('Nama Barang')
                    ->placeholder('-')
                    ->sortable(),
                TextColumn::make('change_in_quantity')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('transaction_type')
                    ->label('Tipe Transaksi')   
                    ->searchable(),
                TextColumn::make('user.name')
                    ->label('Nama')
                    ->placeholder('-')
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageItemTransactions::route('/'),
        ];
    }
}
