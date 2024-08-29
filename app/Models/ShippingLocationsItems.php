<?php

namespace App\Models;

use App\Models\Cities;
use App\Models\Countries;
use App\Models\Governorates;
use App\Models\ShippingLocations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingLocationsItems extends Model
{
    use HasFactory;
    protected $table = 'shipping_locations_items';
    protected $fillable = [
        'shipping_location_id',
        'country_id',
        'governorate_id',
        'city_id',
    ];
    public function shippingLocation()
    {
        return $this->belongsTo(ShippingLocations::class, 'shipping_location_id');
    }
    public function country()
    {
        return $this->belongsTo(Countries::class, 'country_id');
    }
    public function governorate()
    {
        return $this->belongsTo(Governorates::class, 'governorate_id');
    }
    public function city()
    {
        return $this->belongsTo(Cities::class, 'city_id');
    }
}
