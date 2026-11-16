<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    protected $table = 'restauranttables';
    public $timestamps = false;
    protected $primaryKey = 'TableID';
    protected $fillable = [
        'Name',
        'Capacity'
    ];
    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'TableID');
    }
}
