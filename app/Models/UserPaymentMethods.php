<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPaymentMethods extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function apiData(){
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'card_number' => $this->card_number,
            'card_cvv' => $this->card_cvv,
            'card_month' => $this->card_month,
            'card_year' => $this->card_year,
            'primary' => $this->primary,
            'card_date' => $this->card_date,
            'user' => $this->user->name,
        ];
        return $data;
    }
}
