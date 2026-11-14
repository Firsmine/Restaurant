<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'Name',
        'Price',
        'Description',
        'CategoryID'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }
    public function OrderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'MenuItemID');
    }
}
