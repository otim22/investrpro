<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MissedMeetingUpdateRequest extends FormRequest
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
            'charge_paid_for' => ['required', 'string'],
            'charge_amount' => ['required', 'string'],
            'month_paid_for' => ['required', 'string'],
            'date_of_payment' => ['nullable', 'date'],
            'comment' => ['nullable'],
            'member_id' => ['required'],
        ];
    }
}
