<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'name_ar' => 'required|string|max:255',
          'name_en' => 'required|string|max:255',
          'description_ar' => 'nullable|string|max:255',
          'description_en' => 'nullable|string|max:255',
          'metadata_ar' => 'nullable|string|max:255',
          'metadata_en' => 'nullable|string|max:255',
          'keywords_ar' => 'nullable|string|max:255',
          'keywords_en' => 'nullable|string|max:255',
          'type' => 'nullable|string|max:255',
          'price' => 'required|numeric',
          'gift' => 'required',
          'tax_type_id' => 'nullable|numeric',
          'quantity' => 'nullable|numeric',
          'min_quantity' => 'nullable|numeric',
          'discountFromAvailableProducts' => ['nullable', 'in:0,1', 'numeric'],
          'unavailableProductStatus' => ['nullable','string'],
          'shipping' => ['nullable', 'in:0,1', 'numeric'],
          'length' => 'nullable|numeric',
          'width' => 'nullable|numeric',
          'height' => 'nullable|numeric',
          'length_id' => 'nullable|numeric',
          'weight' => 'nullable|numeric',
          'weights_id' => 'nullable|numeric',
          'status' => ['required', 'in:0,1', 'numeric'],
          'ordering' => 'nullable|numeric',
          'company_id' => 'nullable|numeric',
          'category_id' => 'required|numeric',
          'relatedProducts' => 'nullable|string',
          'mainImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      ];
    }
    public function messages()
    {
      return [
        'name_ar.required' => 'يجب ادخال الاسم باللغة العربية',
        'name_en.required' => 'يجب ادخال الاسم باللغة الانجليزية',
        'description_ar.required' => 'يجب ادخال الوصف باللغة العربية',
        'description_en.required' => 'يجب ادخال الوصف باللغة الانجليزية',
        'metadata_ar.required' => 'يجب ادخال البيانات الوصفية باللغة العربية',
        'metadata_en.required' => 'يجب ادخال البيانات الوصفية باللغة الانجليزية',
        'keywords_ar.required' => 'يجب ادخال الكلمات الدلالية باللغة العربية',
        'keywords_en.required' => 'يجب ادخال الكلمات الدلالية باللغة الانجليزية',
        'type.required' => 'يجب ادخال نوع المنتج',
        'price.required' => 'يجب ادخال السعر',
        'tax_type_id.required' => 'يجب ادخال نوع الضريبة',
        'quantity.required' => 'يجب ادخال الكمية',
        'min_quantity.required' => 'يجب ادخال الحد الادنى للكمية',
        'discountFromAvailableProducts.required' => 'يجب ادخال خصم من المنتجات المتوفرة',
        'unavailableProductStatus.required' => 'يجب ادخال حالة المنتجات غير المتوفرة',
        'shipping.required' => 'يجب ادخال الشحن',
        'length.required' => 'يجب ادخال الطول',
        'width.required' => 'يجب ادخال العرض',
        'height.required' => 'يجب ادخال الارتفاع',
        'length_id.required' => 'يجب ادخال وحدة الطول',
        'weight.required' => 'يجب ادخال الوزن',
        'weights_id.required' => 'يجب ادخال وحدة الوزن',
        'status.required' => 'يجب ادخال الحالة',
        'ordering.required' => 'يجب ادخال الترتيب',
        'company_id.required' => 'يجب ادخال الشركة',
        'category_id.required' => 'يجب ادخال القسم',
        'relatedProducts.required' => 'يجب ادخال المنتجات المرتبطة',
        'mainImage.image' => 'يجب ان يكون الملف صورة',
        'mainImage.mimes' => 'يجب ان يكون الملف من نوع jpeg,png,jpg',
        'mainImage.max' => 'يجب ان لا يزيد حجم الملف عن 2048 كيلوبايت',
      ];
    }
}
