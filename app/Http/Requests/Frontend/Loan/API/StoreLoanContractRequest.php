<?php

namespace App\Http\Requests\Frontend\Loan\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreLoanContractRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'consumer_id' => ['required', 'numeric'],
            'investor_id' => ['required', 'numeric'],
            'deal_origin_id' => ['required', 'numeric'],
            'deal_origin_type' => ['required', 'string'],
            'present_value' => ['required', 'numeric'],
            'rate_per_period' => ['required', 'numeric'],
            'number_of_periods' => ['required', 'numeric'],
            'period_type' => ['required','string'],
            'algorithm_type' => ['required','string'],
            'repayment_value' => ['required', 'numeric'],
            'status' => ['required','string'],
        ];
    }

    /*
     * If validation fails return json response with feedback
     */
    protected function failedValidation(Validator $validator)
    {
        return res(400, $validator->errors()->all());
    }
}
