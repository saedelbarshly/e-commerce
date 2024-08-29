<?php

namespace App\Models;

use App\Models\taxRate;
use App\Models\taxType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taxCost extends Model
{
    use HasFactory;
    protected $fillable = [
        'tax_type_id',
        'tax_rate_id',
        'basedOn',
        'priority'
    ];
    public function taxTypes()
    {
        return $this->belongsTo(taxType::class, 'tax_type_id');
    }
    public function taxRates()
    {
        return $this->belongsTo(taxRate::class, 'tax_rate_id');
    }
    public function apiTaxCost($lang)
    {
    //tax Type
      $taxType = $this->taxTypes;
      $taxRate = $this->taxRates;
      $taxRate = [
        'name' => $taxRate['name_' . $lang],
        'price' => $taxRate['price'],
        'type' => $taxRate['type'],
        'geographicalArea' => $taxRate['geographicalArea'],
      ];
      $taxType = [
        'name' => $taxType['name_' . $lang],
        'description' => $taxType['description_' . $lang],
      ];
        return [
            'taxType' => $taxType,
            'taxRate' => $taxRate,
            'basedOn' => $this['basedOn'],
            'priority' => $this['priority'],
        ];
    }
}
