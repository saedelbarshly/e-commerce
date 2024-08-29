<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
        'image' => 'required|image|mimes:png,jpg,jpeg',
      ];
    }

}
