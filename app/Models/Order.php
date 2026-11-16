<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    public $timestamps = false;
    protected $primaryKey = 'OrderID';
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
