<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditClientWorkRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'medium' => 'required',
            'year_completed' => 'required',
            'client_image' => 'nullable|image|max:2024',
            'category' => 'required',
            'visibility' => 'required',
            'status' => 'required'
        ];
    }
}