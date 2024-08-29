<?php

namespace App\Models;

use App\Models\Categories;
use App\Models\Companies;
use App\Models\Option;
use App\Models\optionTypes;
use App\Models\optionValue;
use App\Models\productDiscount;
use App\Models\productImage;
use App\Models\productReview;
use App\Models\productSpecialOffer;
use App\Models\Specification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function photoLink()
    {
      $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
      if ($this->mainImage != ''  && file_exists(public_path('uploads/products/' . $this->id . '/' . $this->mainImage))) {
        $image = asset('uploads/products/' . $this->id . '/' . $this->mainImage);
      }
      return $image;
    }
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function companies()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
    public function taxType()
    {
        return $this->belongsTo(taxType::class, 'tax_type_id');
    }
    public function length()
    {
        return $this->belongsTo(Length::class, 'length_id');
    }
    public function productDiscounts()
    {
        return $this->hasMany(productDiscount::class, 'product_id');
    }
    public function productSpecialOffers()
    {
        return $this->hasMany(productSpecialOffer::class, 'product_id');
    }
    public function productImages()
    {
        return $this->hasMany(productImage::class, 'product_id');
    }
    public function specifications()
    {
        return $this->belongsToMany(Specification::class, 'product_specifications', 'product_id', 'specification_id')
          ->withPivot('description_ar', 'description_en');
    }
    // public function optionValues()
    // {
    //     return $this->belongsToMany(optionValue::class, 'product_option', 'product_id', 'option_value_id')
    //       ->withPivot('optionRequired','optionQuantity','optionPrice', 'optionDiscountFromAvailableProducts');
    // }
    // public function optionTypes()
    // {
    //     return $this->belongsToMany(optionTypes::class, 'product_option', 'product_id', 'option_type_id');
    // }
    public function options()
    {
      return $this->hasMany(ProductOption::class, 'product_id');
    }

    public function slugName() {
      return str_replace(' ', '-', $this->name_ar);
    }

    public function apiData($lang){
      $data = [
        'id' => $this->id,
        'name' => $this['name_' . $lang],
        'description' => $this['description_' . $lang],
        'metadata' => $this['metadata_' . $lang],
        'keywords' => $this['keywords_' . $lang],
        'type' => $this['type'],
        'status' => ($this['status'] == 1 ? trans('api.available') : trans('api.notAvailable')),
        'ordering' => $this['ordering'],
        'price' => $this->price,
        'quantity' => $this->quantity,
        'min_quantity' => $this->min_quantity,
        'discountFromAvailableProducts' => ($this['discountFromAvailableProducts'] == 1 ? trans('api.yes') : trans('api.no')),
        'unavailableProductStatus' => $this['unavailableProductStatus'],
        'shipping' => ($this->shipping == 1 ? trans('api.yes') : trans('api.no')),
        'main_image' => $this->photoLink(),
        'length' => $this->length,
        'width' => $this->width,
        'height' => $this->height,
        'weight' => $this->weight,
        'category' => $this->categories['name_' . $lang],
        'company' => $this->companies['name_' . $lang],
        'specifications' => [],
        'options' => [],
        'discounts' => [],
        'specialOffers' => [],
        'images' => [],
      ];
      foreach ($this->specifications as $specification) {
        $data['specifications'][] = [
          'id' => $specification->id,
          'name' => $specification['name_' . $lang],
          'description' => $specification->pivot['description_' . $lang],
        ];
      }
      foreach ($this->optionTypes as $optionType) {
        $data['options'][] = [
          'id' => $optionType->id,
          'OptionTypeName' => $optionType['name_' . $lang],
          'values' => [],
        ];
      }
      // foreach ($this->optionValues as $optionValue) {
      //   $data['options'][$optionValue->optionType->id - 1]['values'][] = [
      //     'id' => $optionValue->id,
      //     'option' => $optionValue->option['name_' . $lang],
      //     'name' => $optionValue['name_' . $lang],
      //     'optionPrice' => $optionValue->pivot['optionPrice'],
      //     'optionQuantity' => $optionValue->pivot['optionQuantity'],
      //     'optionRequired' => $optionValue->pivot['optionRequired'],
      //     'optionDiscountFromAvailableProducts' => $optionValue->pivot['optionDiscountFromAvailableProducts'],
      //   ];
      // }
      foreach ($this->productDiscounts as $productDiscount) {
        $data['discounts'][] = [
          'id' => $productDiscount->id,
          'quantity' => $productDiscount->quantity,
          'price' => $productDiscount->price,
          'start_date' => $productDiscount->start_date,
          'end_date' => $productDiscount->end_date,
        ];
      }
      foreach ($this->productSpecialOffers as $productSpecialOffer) {
        $data['specialOffers'][] = [
          'id' => $productSpecialOffer->id,
          'price' => $productSpecialOffer->price,
          'priority' => $productSpecialOffer->priority,
          'start_date' => $productSpecialOffer->start_date,
          'end_date' => $productSpecialOffer->end_date,
        ];
      }
      foreach ($this->productImages as $productImage) {
        $data['images'][] = [
          'id' => $productImage->id,
          'image' => asset('uploads/products/' . $this->id . '/' . $productImage->image),
        ];
      }
      return $data;
    }
    public function scopeFilter(Builder $builder, $filters, $lang){
        if($filters['name'] ?? false){
            $builder->where('name_ar', 'like', '%' . $filters['name'] . '%')
                ->orWhere('name_en', 'like', '%' . $filters['name'] . '%');
        }
        if($filters['status'] ?? false){
            $builder->where('status', $filters['status']);
        }
        if($filters['category'] ?? false){
            $builder->where('category_id', $filters['category']);
        }
    }

    public function checkDiscount($price, $quantity){
      $price = $this->price;
      if($this->productDiscounts()->where('start_date', '<=', date('Y-m-d'))
        ->where('end_date', '>=', date('Y-m-d'))->count() > 0){
        $discount = $this->productDiscounts()->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->where('quantity', '<=', $quantity)->orderBy('quantity', 'desc')->first();
        if($discount){
          $price -= $discount->price ;
        }
      }
      return $price;
    }
    public function realPriceAfterDiscount() {
      if ($this->checkDiscount($this->price, 1) > $this->price) {
        return $this->checkDiscount($this->price, 1);
      }
      return $this->price;
    }
    public function taxTotal() {
      $tax = 0;
      if ($this->taxType != '') {
        if ($this->taxType->apiTaxType(session()->get('Lang'))['taxCost'] > 0) {
          $tax = $this->taxType->taxRates()->sum('price');
        }
      }
      return $tax;
    }
    public function productReviews()
    {
        return $this->hasMany(productReview::class, 'product_id');
    }
    public function countReviews(){
      $reviews = $this->productReviews()->get();
      $count = $reviews->count();
      $sum = 0;
      foreach ($reviews as $review) {
        $sum += $review->rating;
      }
      return ceil($count > 0 ? $sum / $count : 0);
    }
}
