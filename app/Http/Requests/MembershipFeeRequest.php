<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembershipFeeRequest extends FormRequest
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
            'fee_amount' => ['required', 'string'],
            'year_paid_for' => ['required', 'string'],
            'date_of_payment' => ['nullable', 'date'],
            'member_id' => ['required'],
            'comment' => ['nullable'],
        ];
    }
}
