<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            'sympl_ar' => 'required|string|max:255',
            'sympl_en' => 'required|string|max:255',
            'transfer_rate' => 'required|numeric',
            'primary' => 'numeric|in:1,0',
            'country' => 'required'
        ];
    }
}
