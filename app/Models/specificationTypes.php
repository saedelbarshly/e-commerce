<?php

namespace App\Models;

use App\Models\Specification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specificationTypes extends Model
{
    use HasFactory;
    protected $table = 'specification_types';
    protected $fillable = [
        'name_ar',
        'name_en',
        'ordering',
    ];
    public function specifications()
    {
        return $this->hasMany(Specification::class, 'specification_type_id');
    }
    public function apiData($lang){
        return [
            'id' => $this['id'],
            'name' => $this['name_'.$lang],
            'ordering' => $this['ordering'],
        ];
    }
}
