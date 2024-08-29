<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class optionCategories extends Model
{
    use HasFactory;
    protected $table = 'option_categories';
    protected $fillable = [
        'name_ar',
        'name_en',
    ];
    public function optionTypes()
    {
        return $this->hasMany(optionTypes::class);
    }
}
