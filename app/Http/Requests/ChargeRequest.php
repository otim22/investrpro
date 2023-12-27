<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargeRequest extends FormRequest
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
            'asset_type' => ['required', 'string'],
            'financial_year' => ['required', 'string'],
            'charge' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'month' => ['nullable', 'string'],
            'date_paid' => ['nullable', 'date'],
            'has_paid' => ['nullable'],
            'comment' => ['nullable'],
            'member_id' => ['required'],
        ];
    }
}
