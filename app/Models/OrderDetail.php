<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'OrderID',
        'MenuItemID',
        'Quantity',
        'Price'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'OrderID');
    }
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'MenuItemID');
    }
}
