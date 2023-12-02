<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberSavingsRequest extends FormRequest
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
            'financial_year' => ['required', 'string'],
            'premium' => ['required', 'string'],
            'month' => ['required', 'string'],
            'date_paid' => ['required', 'date'],
            'member_id' => ['required'],
            'comment' => ['nullable'],
        ];
    }
}
