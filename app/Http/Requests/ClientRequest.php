<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'client_image' => 'nullable|image|max:2024',
            'client_image_gallery.*' =>  'nullable|image|max:2024',
            'client_works.*.title' => 'required',
            'client_works.*.medium' => 'required',
            'client_works.*.year_completed' => 'required',
            'client_works.*.client_image' => 'required|image|max:2024',
        ];
    }
}
