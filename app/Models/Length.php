<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Length extends Model
{
    use HasFactory;
    protected $table = 'lengths';
    protected $fillable = [
        'title_ar',
        'title_en',
        'unit_length_ar',
        'unit_length_en',
        'value',
        'primary',
    ];
  public function apiData($lang)
  {
    return [
      'id' => $this->id,
      'title' => $this['title_' . $lang],
      'unit_length' => $this['unit_length_' . $lang],
      'value' => $this['value'],
      'primary' => $this['primary'],
    ];
  }
}
