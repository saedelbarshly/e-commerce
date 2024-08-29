<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar',
        'title_en',
        'unit_weight_ar',
        'unit_weight_en',
        'value',
        'primary',
    ];
    public function apiData($lang)
    {
      return [
        'id' => $this->id,
        'title' => $this['title_' . $lang],
        'unit_weight' => $this['unit_weight_' . $lang],
        'value' => $this['value'],
        'primary' => $this['primary'],
      ];
    }
}
