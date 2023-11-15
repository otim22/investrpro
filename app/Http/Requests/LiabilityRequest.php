<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiabilityRequest extends FormRequest
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
            'liability_name' => ['required', 'string'],
            'liability_type' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'financial_year' => ['required', 'string'],
            'date_acquired' => ['required', 'date'],
        ];
    }
}
