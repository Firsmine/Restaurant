<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'TableID',
        'CustomerName',
        'TransactionName',
        'Status'
    ];
    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'TableID');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'TransactionID');
    }
}
