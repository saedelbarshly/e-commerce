<?php

namespace App\Models;

use App\Models\ShippingLocationsItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingLocations extends Model
{
    use HasFactory;
    protected $table = 'shipping_locations';
    protected $fillable = [
        'name_ar',
        'name_en',
        'price',
    ];
    public function items()
    {
        return $this->hasMany(ShippingLocationsItems::class, 'shipping_location_id');
    }
}
