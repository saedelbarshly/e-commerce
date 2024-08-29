<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polices extends Model
{
    use HasFactory;
    protected $table = 'polices';
    protected $fillable = [
        'description_ar',
        'description_en',
        'ranking',
    ];
}
