<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTransaction extends Model
{
    protected $fillable = [
        'item_id',
        'transaction_type',
        'change_in_quantity',
        'user_id'   
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
