<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productReview extends Model
{
    use HasFactory;
    protected $table = 'product_reviews';
    protected $fillable = [
        'content',
        'rating',
        'product_id',
        'user_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function stars()
    {
        return ratingStars($this->rating);
    }
    public function reverseStatus()
    {
      if ($this->published == 0) {
        return [
          'text' => trans('common.verfiy'),
          'class' => 'btn-success',
          'icon' => 'shield-off'
        ];
      } else {
        return [
          'text' => trans('common.block'),
          'class' => 'btn-danger',
          'icon' => 'shield'
        ];
      }

    }

    public function apiData($lang) {
      return [
        'id' => $this->id,
        'rating' => $this->rating,
        'content' => $this->content,
        'user' => $this->user->apiData($lang),
        'product' => $this->product->apiData($lang)
      ];
    }
}
