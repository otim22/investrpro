<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestmentUpdateRequest extends FormRequest
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
            'investment_type' => ['required', 'string'],
            'date_of_investment' => ['required', 'date'],
            'duration' => ['required', 'string'],
            'interest_rate' => ['required', 'string'],
            'amount_invested' => ['required', 'string'],
            'date_of_maturity' => ['required', 'date'],
            'expected_return_before_tax' => ['required', 'string'],
            'expected_return_after_tax' => ['nullable', 'string'],
            'interest_recieved_and_reinvested' => ['nullable', 'string'],
        ];
    }
}
