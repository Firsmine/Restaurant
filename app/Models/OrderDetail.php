<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    protected $table = 'orderdetails';
    public $timestamps = false;
    protected $primaryKey = 'OrderDetailID';
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
