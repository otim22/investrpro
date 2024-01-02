<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanApplicationRequest extends FormRequest
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
            'credit_type' => 'required|string',
            'credit_purpose' => 'required|string',
            'amount_requested' => 'required|string',
            'repayment_plan' => 'required|string',
            'signature' => 'required|string',
            'financial_year' => 'required|string',
            'member_id' => 'required',
        ];
    }
}
