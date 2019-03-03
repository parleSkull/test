<?php

namespace App\Http\Requests\Frontend\Loan\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateLoanRequestRequest extends FormRequest
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
            'present_value' => ['required', 'numeric'],
            'number_of_periods' => ['required', 'numeric'],
            'period_type' => ['required','string'],
            'granted' => ['required','boolean']
        ];
    }

    /*
     * If validation fails return json response with feedback
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        return res(400, $errors);
    }
}
