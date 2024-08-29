<?php

namespace App\Models;

use App\Models\orderAddress;
use App\Models\productReview;
use App\Models\roles;
use App\Models\Wishlist;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\Intl\Countries;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use AuthenticableTrait;
    protected $table = 'users';

    protected $guard = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hisRole()
    {
        return $this->belongsTo(roles::class,'role');
    }
    public function photoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');

        if ($this->photo != '') {
            $image = asset('uploads/users/'.$this->id.'/'.$this->photo);
        }

        return $image;
    }
    public function licensePhotoLink()
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');

        if ($this->licensePhoto != '') {
            $image = asset('uploads/users/'.$this->id.'/'.$this->licensePhoto);
        }

        return $image;
    }
    public function countryData()
    {
        $country = '';
        $lang = app()->getLocale();
        $countries = Countries::getNames($lang);
        foreach ($countries as $key => $value) {
            if ($key == $this->country) {
                $country = $value;
            }
        }
        return $country;
    }
    public function governorateData()
    {
        return $this->belongsTo(Governorates::class,'governorate');
    }
    public function cityData()
    {
        return [
            'id' => $this->city,
            'name' => $this->city,
        ];
        return $this->belongsTo(Cities::class,'city');
    }
    public function addressList()
    {
        return $this->hasMany(UserAddress::class,'user_id');
    }
    public function paymentMethods()
    {
        return $this->hasMany(UserPaymentMethods::class,'user_id');
    }
    public function myPaymentMethods($lang)
    {
        $data = [];
        foreach ($this->paymentMethods as $key => $value) {
            $data[] = $value->apiData($lang);
        }
        return $data;
    }
    public function favorites()
    {
        return $this->hasMany(UserFavorites::class,'user_id');
    }
    public function apiData($lang,$details = null)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'language' => $this->language,
            'phone' => $this->phone,
            'address' => $this->address,
            'photo' => $this->photoLink(),
        ];
        return $data;
    }

    public function checkActive()
    {
        $active = '1';
        if ($this->active == '0') {
            $active = trans('auth.yourAcountStillNotActive');
        }
        if ($this->block == '1') {
            $active = trans('auth.yourAcountIsBlocked');
        }
        return $active;
    }

    public function paymentsHistory()
    {
        return $this->hasMany(PublisherPaymentsHistory::class,'user_id');
    }

    public function currentBalance()
    {
        $sales = $this->mySales()->sum('total');
        $payments = $this->paymentsHistory()->sum('amount');
        return [
            'balance' => $sales-$payments,
            'balanceRate' => (($sales-$payments)/getSettingValue('MinimumForTransfeerMoney'))*100
        ];
    }

    public function myOrders()
    {
        return $this->hasMany(Orders::class,'user_id');
    }

    public function cart()
    {
        // return $this->hasMany(Cart::class,'user_id');
        return $this->myOrders()->where('status','cart')->first();
    }
    public function myCart($lang,$currency = null)
    {
      $cart = $this->cart();
      if ($cart != null) {
          return $cart->apiData($lang,$currency);
      }else {
          return null;
      }
    }
    public function addresses()
    {
        return $this->hasMany(orderAddress::class,'user_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class,'user_id');
    }
    public function productReviews()
    {
        return $this->hasMany(productReview::class,'user_id');
    }
}
