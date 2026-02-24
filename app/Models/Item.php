<?php

namespace App\Models;

use App\TransactionType;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity',
    ];

    public function transactions()
    {
        return $this->hasMany(ItemTransaction::class);
    }


    public function setQuantityAttribute()
    {
        return $this->transactions()->get()->sum(function ($transaction) {
            return $transaction->transaction_type === TransactionType::INCOMING
                ? $transaction->change_in_quantity
                : -$transaction->change_in_quantity;
        });
    }
    public function getQtyAttribute()
    {
        return $this->transactions()->get()->sum(function ($transaction) {
            return $transaction->transaction_type === TransactionType::INCOMING
                ? $transaction->change_in_quantity
                : -$transaction->change_in_quantity;
        });
    }
}
