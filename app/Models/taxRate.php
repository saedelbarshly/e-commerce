<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taxRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'price',
        'type',
        'geographicalArea',
    ];
    public function taxTypes()
    {
        return $this->belongsToMany(taxType::class, 'tax_costs', 'tax_rate_id', 'tax_type_id')->withPivot('basedOn', 'priority');
    }
    public function taxCosts()
    {
        return $this->hasMany(taxCost::class, 'tax_rate_id');
    }
  public function apiTaxRate($lang)
  {

    return [
      'id' => $this['id'],
      'name' => $this['name_' . $lang],
      'price' => $this['price'],
      'type' => $this['type'],
      'geographicalArea' => $this['geographicalArea'],
      
    ];
  }

}
