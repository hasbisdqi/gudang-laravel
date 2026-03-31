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

    public function adjustStock(TransactionType $type, int $qty)
    {
        if ($type === TransactionType::OUTGOING) {
            if ($this->quantity < $qty) {
                return;
            }
            $this->decrement('quantity', $qty);
        } else {
            $this->increment('quantity', $qty);
        }
    }
}
