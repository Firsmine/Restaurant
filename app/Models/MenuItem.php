<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes;
    protected $table = 'menuitems';
    public $timestamps = false;
    protected $primaryKey = 'MenuItemID';

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
