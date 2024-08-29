<?php

namespace App\Models;

use App\Models\taxCost;
use App\Models\taxRate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class taxType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
    ];
    public function taxRates()
    {
        return $this->belongsToMany(taxRate::class, 'tax_costs', 'tax_type_id', 'tax_rate_id')->withPivot('basedOn', 'priority');
    }
    public function taxCosts()
    {
        return $this->hasMany(taxCost::class, 'tax_type_id');
    }
    public function apiTaxType($lang)
    {
      $taxCost = [];
      foreach ($this->taxCosts as $taxCosts) {
        $taxCost[] = $taxCosts->apiTaxCost($lang);
      }
        return [
            'id' => $this['id'],
            'name' => $this['name_' . $lang],
            'description' => $this['description_' . $lang],
            'taxCost' => $taxCost,
        ];
    }


}
