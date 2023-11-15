<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
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
            'asset_name' => ['required', 'string'],
            'asset_type' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'financial_year' => ['required', 'string'],
            'date_acquired' => ['required', 'date'],
        ];
    }
}
