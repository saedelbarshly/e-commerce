<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
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
      'title_ar' => 'required|string',
      'title_en' => 'required|string',
      'description_ar' => 'required|string',
      'description_en' => 'required|string',
      'image' => 'nullable|image|mimes:png,jpg,jpeg',
    ];
  }
  public function messages()
  {
    return [
      'title_ar.required' => 'الإسم بالعربية مطلوب',
      'title_en.required' => 'الإسم بالانجليزية مطلوب',
      'description_ar.required' => 'الوصف بالعربية مطلوب',
      'description_en.required' => 'الوصف بالانجليزية مطلوب',
      'image.mimes' => 'يجب ان تكون الصورة من نوع png, jpg, jpeg',
      'image.image' => 'يجب ان يكون حقل الصورة من نوع صورة',
    ];
  }
}
