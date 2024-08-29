<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Length;
use App\Models\Option;
use App\Models\optionTypes;
use App\Models\optionValue;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionItems;
use App\Models\productImage;
use App\Models\Specification;
use App\Models\taxType;
use App\Models\Weight;
use Illuminate\Http\Request;
use Response;

class ProductsController extends Controller
{
  public function index()
  {
    // $products = Product::orderBy('ordering', 'desc')->paginate(10);
    $request = request();
    $products = Product::filter($request->query(), app()->getLocale())
      ->orderBy('id', 'desc')->paginate(25);
    return view('AdminPanel.products.index', [
      'active' => 'products',
      'title' => trans('common.products'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.products')
        ]
      ]
    ], compact('products'));
  }
  public function create()
  {
    $taxTypes = taxType::pluck('name_' . app()->getLocale(), 'id');
    $lengths = Length::pluck('title_' . app()->getLocale(), 'id');
    $weights = Weight::pluck('title_' . app()->getLocale(), 'id');
    $specifications = Specification::pluck('name_' . app()->getLocale(), 'id');
    $optionTypes = optionTypes::pluck('name_' . app()->getLocale(), 'id');
    $options = Option::pluck('name_' . app()->getLocale(), 'id')->all();
    $optionValues = optionValue::pluck('name_' . app()->getLocale(), 'id');
    $companies = Companies::pluck('name_' . app()->getLocale(), 'id');
    $categories = Categories::pluck('name_' . app()->getLocale(), 'id');
    return view('AdminPanel.products.create', [
      'active' => 'products',
      'title' => trans('common.products'),
      'breadcrumbs' => [
        [
          'url' => route('admin.products'),
          'text' => trans('common.products')
        ], [
          'url' => '',
          'text' => trans('common.CreateNew')
        ]
      ]
    ], compact('taxTypes', 'lengths', 'weights', 'specifications', 'optionTypes', 'optionValues', 'options', 'companies', 'categories'));
  }
  public function store(ProductStoreRequest $request)
  {
    // dd($request->all());
    // $options = [];
    // if (isset($request['optionSelector'])) {
    //   // foreach ($request['optionSelector'] as $option) {
    //     // if (isset($request['optionValuePrice'][$option])) {
    //       // $options[$option] = [];
    //       // foreach ($request['optionValuePrice'] as $key => $value) {
    //       //   $options[$option][] = [
    //       //     'option_item_id' => $key,
    //       //     'option_item_value' => $value
    //       //   ];
    //       // }
    //     // }
    //   // }
    // }
    // // return $request['optionValuePrice'];
    $data = $request->validated();
    // dd($data);
    $product = Product::create($data);
    if (isset($_POST['specification_id'])) {
      for ($i = 0; $i < count($request->specification_id); $i++) {
        $product->specifications()->attach($request->specification_id[$i]);
        $product->specifications()->updateExistingPivot($request->specification_id[$i], ['description_ar' => $request->specificationDescription_ar[$i], 'description_en' => $request->specificationDescription_en[$i]]);
      }
    }
    if (isset($_POST['optionSelector'])) {
      for ($i = 0; $i < count($request->optionSelector); $i++) {
        $create_option = ProductOption::create([
          'product_id' => $product->id,
          'option_id' => $request->optionSelector[$i]
        ]);
        if (isset($request['optionValuePrice'])) {
          if (count($request['optionValuePrice']) > 0) {
            foreach ($request['optionValuePrice'] as $option_id => $option_values) {
              if ($option_id == $request->optionSelector[$i]) {
                foreach ($option_values as $key => $value) {
                  $create_option_item = ProductOptionItems::create([
                    'product_id' => $product->id,
                    'product_option_id' => $create_option->id,
                    'option_value_id' => $key,
                    'price' => $value
                  ]);
                }
              }
            }
          }
        }
      }
    }

    if (isset($_POST['DiscountQuantity'])) {
      for ($i = 0; $i < count($request->DiscountQuantity); $i++) {
        $product->productDiscounts()->create([
          'quantity' => $request->DiscountQuantity[$i],
          'price' => $request->DiscountPrice[$i],
          'start_date' => $request->DiscountStartDate[$i],
          'end_date' => $request->DiscountEndDate[$i],
          'priority' => $request->DiscountPriority[$i],
        ]);
      }
    }
    if (isset($_POST['specialOfferPrice'])) {
      for ($i = 0; $i < count($request->specialOfferPrice); $i++) {
        $product->productSpecialOffers()->create([
          'price' => $request->specialOfferPrice[$i],
          'start_date' => $request->specialOfferStartDate[$i],
          'end_date' => $request->specialOfferEndDate[$i],
          'priority' => $request->specialOfferPriority[$i],
        ]);
      }
    }
    if ($request->mainImage != '') {
      $product['mainImage'] = upload_image_without_resize('products/' . $product->id, $request->mainImage);
      $product->update();
    }
    if (isset($_FILES['additionalImages'])) {
      for ($i = 0; $i < count($request->additionalImages); $i++) {
        $product->productImages()->create([
          'additionalImages' => upload_image_without_resize('products/' . $product->id, $request->additionalImages[$i]),
        ]);
      }
    }
    if ($product) {
      return redirect()->route('admin.products')
        ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  public function edit(Product $product)
  {
    $lang = app()->getLocale();
    $product->load('specifications', 'productDiscounts', 'productSpecialOffers', 'productImages');
    $product_options = $product->options;
    $taxTypes = taxType::pluck('name_' . $lang, 'id');
    $lengths = Length::pluck('title_' . $lang, 'id');
    $weights = Weight::pluck('title_' . $lang, 'id');
    $options = Option::pluck('name_' . app()->getLocale(), 'id')->all();
    $specifications = Specification::pluck('name_' . $lang, 'id');
    $companies = Companies::pluck('name_' . $lang, 'id');
    $categories = Categories::pluck('name_' . $lang, 'id');
    return view('AdminPanel.products.edit', [
      'active' => 'products',
      'title' => trans('common.products'),
      'breadcrumbs' => [
        [
          'url' => route('admin.products'),
          'text' => trans('common.products')
        ], [
          'url' => '',
          'text' => trans('common.edit')
        ]
      ]
    ], compact('lang', 'product', 'taxTypes', 'lengths', 'weights', 'specifications', 'companies', 'categories', 'product_options', 'options'));
  }
  //update product
  public function update(ProductUpdateRequest $request, Product $product)
  {
    // dd($request->all());
    $data = $request->validated();
    $product->update($data);
    if (isset($_POST['specification_id'])) {
      $product->specifications()->detach();
      for ($i = 0; $i < count($request->specification_id); $i++) {
        $product->specifications()->attach($request->specification_id[$i]);
        $product->specifications()->updateExistingPivot($request->specification_id[$i], ['description_ar' => $request->specificationDescription_ar[$i], 'description_en' => $request->specificationDescription_en[$i]]);
      }
    }

    //delete old options if exist
    if ($product->options()->count() > 0) {
      foreach ($product->options as $old_option) {
        if ($product->options()->count() > 0) {
          $old_option->options()->delete();
        }
      }
      $product->options()->delete();
    }
    //update or create new options if request exist
    if (isset($request['optionSelector'])) {
      if (count($request['optionSelector']) > 0) {
        foreach ($request['optionSelector'] as $key => $value) {
          $create_option = ProductOption::create([
            'product_id' => $product->id,
            'option_id' => $value
          ]);
          if (isset($request['optionValuePrice'])) {
            if (count($request['optionValuePrice']) > 0) {
              foreach ($request['optionValuePrice'] as $option_id => $option_values) {
                if ($option_id == $value) {
                  foreach ($option_values as $key => $value) {
                    $create_option_item = ProductOptionItems::create([
                      'product_id' => $product->id,
                      'product_option_id' => $create_option->id,
                      'option_value_id' => $key,
                      'price' => $value
                    ]);
                  }
                }
              }
            }
          }
        }
      }
    }
    if (isset($_POST['DiscountQuantity'])) {
      $product->productDiscounts()->delete();
      for ($i = 0; $i < count($request->DiscountQuantity); $i++) {
        $product->productDiscounts()->create([
          'quantity' => $request->DiscountQuantity[$i],
          'price' => $request->DiscountPrice[$i],
          'start_date' => $request->DiscountStartDate[$i],
          'end_date' => $request->DiscountEndDate[$i],
          'priority' => $request->DiscountPriority[$i],
        ]);
      }
    }
    if (isset($_POST['specialOfferPrice'])) {
      $product->productSpecialOffers()->delete();
      for ($i = 0; $i < count($request->specialOfferPrice); $i++) {
        $product->productSpecialOffers()->create([
          'price' => $request->specialOfferPrice[$i],
          'start_date' => $request->specialOfferStartDate[$i],
          'end_date' => $request->specialOfferEndDate[$i],
          'priority' => $request->specialOfferPriority[$i],
        ]);
      }
    }
    if ($request->mainImage != '') {
      $product['mainImage'] = upload_image_without_resize('products/' . $product->id, $request->mainImage);
      $product->update();
    }
    if (isset($_FILES['additionalImages'])) {
      if ($request->additionalImages != '') {
        foreach ($request->additionalImages as $image) {
          $product->productImages()->create([
            'additionalImages' => upload_image_without_resize('products/' . $product->id, $image),
          ]);
        }
      } else {
        foreach ($product->productImages as $image) {
          if ($image->additionalImages == '') {
            $image->delete();
            delete_image('uploads/products/' . $product->id, $image->additionalImages);
          }
        }
      }
    }
    if ($product) {
      return redirect()->route('admin.products')
        ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  //delete product
  public function delete(Product $product)
  {
    //delete old options if exist
    if ($product->options()->count() > 0) {
      foreach ($product->options as $old_option) {
        if ($product->options()->count() > 0) {
          $old_option->options()->delete();
        }
      }
      $product->options()->delete();
    }

    if ($product->delete()) {
      return Response::json($product->id);
    } else {
      return Response::json("false");
    }
  }
  public function deleteImage($key)
  {
    $product = Product::where('mainImage', $key)->first();
    if ($product->mainImage != '') {
      delete_image('uploads/products/' . $product->id, $product->mainImage);
      $product->mainImage = '';
      $product->update();
    }
    session()->flash('success', trans('common.successMessageText'));
    return back();
  }
  public function Images($key)
  {
    $image = productImage::where('additionalImages', $key)->first();
    if ($image->additionalImages != '') {
      delete_image('uploads/products/' . $image->product_id, $image->additionalImages);
      $image->additionalImages = '';
      $image->update();
    }
    session()->flash('success', trans('common.successMessageText'));
    return back();
  }



  public function getOptionDetails()
  {
    $option = Option::find($_GET['option']);
    $optionValueList = '';
    if ($option->optionValues()->count() > 0) {
      foreach ($option->optionValues as $key => $value) {
        $optionValueList .= '<div class="col-12 mb-1">';
        $optionValueList .= '<div class="row">';
        $optionValueList .= '<div class="col-md-3">';
        $optionValueList .= '<label for="">الاسم بالعربية</label>';
        $optionValueList .= '<input type="text" name="" id="" class="form-control" value="' . $value['name_ar'] . '" disabled>';
        $optionValueList .= '</div>';
        $optionValueList .= '<div class="col-md-3">';
        $optionValueList .= '<label for="">الاسم بالإنجليزية</label>';
        $optionValueList .= '<input type="text" name="" id="" class="form-control" value="' . $value['name_en'] . '" disabled>';
        $optionValueList .= '</div>';
        $optionValueList .= '<div class="col-md-3">';
        $optionValueList .= '<label for="">السعر الإضافي</label>';
        $optionValueList .= '<input type="number" name="optionValuePrice[' . $_GET['option'] . '][' . $value['id'] . ']" id="" class="form-control" value="0" step=".01">';
        $optionValueList .= '</div>';

        $optionValueList .= '<div class="col-12 col-md-2">';
        $optionValueList .= '<button type="button" class="btn btn-danger mt-2" onclick="removeThisOptionItem(this)">';
        $optionValueList .= 'إزالة الخيار';
        $optionValueList .= '</button>';
        $optionValueList .= '</div>';

        $optionValueList .= '</div>';
        $optionValueList .= '</div>';
      }
    }

    return $optionValueList;
  }
}
