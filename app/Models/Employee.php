<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Hidden(['password', 'remember_token'])]
class Employee extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;
    public $timestamps = false;
    protected $fillable = [
        'Name',
        'Role',
        'Phone',
        'Email',
        'HireDate',
        'Password'
    ];
    protected function casts(): array
    {
        return [
            'Password' => 'hashed',
            'HireDate' => 'datetime'
        ];
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'EmployeeID');
    }
}
