<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $table = 'transactions';
    public $timestamps = false;
    protected $primaryKey = 'TransactionID';
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
