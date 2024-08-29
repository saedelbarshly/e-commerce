<?php

namespace App\Models;

use App\Models\Countries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Governorates extends Model
{
  use HasFactory;
  protected $table = 'governorates';
  protected $fillable = [
    'name_ar',
    'name_en',
    'country_id',
  ];
  public function country()
  {
    return $this->belongsTo(Countries::class, 'country_id');
  }
  public function users()
  {
    return $this->hasMany(User::class, 'governorate');
  }
  public function cities()
  {
    return $this->hasMany(Cities::class, 'governorate_id');
  }
  public function apiData($lang)
  {
    return [
      'id' => $this->id,
      'name' => $this['name_' . $lang] != '' ? $this['name_' . $lang] : $this['name_en'],
      'country' => $this->country->apiData($lang),
    ];
  }
}
