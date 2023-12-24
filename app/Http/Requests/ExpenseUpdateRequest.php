<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseUpdateRequest extends FormRequest
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
            'expense_name' => ['required', 'string'],
            'expense_type' => ['required', 'string'],
            'financial_year' => ['required', 'string'],
            'date_of_expense' => ['required', 'date'],
            'details' => ['required', 'string'],
            'rate' => ['nullable', 'string'],
            'amount' => ['required'],
        ];
    }
}
