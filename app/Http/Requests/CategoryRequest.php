<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img.*' => 'required|image|max:2048|mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ];
    }
}
