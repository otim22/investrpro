<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'surname' => ['required', 'string'],
            'given_name' => ['required', 'string'],
            'other_name' => ['nullable', 'string'],
            'date_of_birth' => ['required', 'date'],
            'telephone_number' => ['required', 'numeric', 'min:10'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'address' => ['required', 'string'],
            'occupation' => ['required', 'string'],
            'nin' => ['required_without:passport_number'],
            'passport_number' => ['required_without:nin'],
        ];
    }
}
