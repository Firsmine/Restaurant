<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'TransactionID',
        'EmployeeID',
        'OrderTime'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'EmployeeID');
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'TransactionID');
    }
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'OrderDetailID');
    }
}
