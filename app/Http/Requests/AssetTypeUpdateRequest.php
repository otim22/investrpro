<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetTypeUpdateRequest extends FormRequest
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
            'asset_type' => 'required|string',
            'description' => 'nullable|string',
        ];
    }
}