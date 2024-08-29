<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderAddress extends Model
{
    use HasFactory;
    protected $table = 'order_addresses';
    protected $fillable = [
        'user_id',
        'order_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'city',
        'country',
        'address',
        'deliveryMethod',
      'addressDescription',
        'postalCode',
        'type'
    ];
    public function order(){
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function countryData()
    {
      return $this->hasOne(Countries::class, 'iso','country');
    }
}
