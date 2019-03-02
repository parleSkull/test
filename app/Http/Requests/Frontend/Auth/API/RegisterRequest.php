<?php

namespace App\Http\Requests\Frontend\Auth\API;

use App\Enums\AccountType;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
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
            'account_type'         => ['required', 'string', Rule::in(AccountType::getValues())],
            'username'             => ['required', 'string', 'max:191', Rule::unique('users')],
            'email'                => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'phone_number'         => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password'             => ['required', 'string', 'min:6', 'confirmed']
//            'first_name'           => ['string', 'max:191'],
//            'last_name'            => ['string', 'max:191', function ($attribute, $value, $fail){
//                if($value == AccountType::INSTITUTION){
//                    $fail($attribute.' is required.');
//                }
//            }],

        ];

        /*return [
            'account_type'         => ['required', 'string', Rule::in(AccountType::getKeys())],
            'username'             => ['required', 'string', 'max:191', Rule::unique('users')],
            'first_name'           => ['required', 'string', 'max:191'],
            'last_name'            => ['string', 'max:191', function ($attribute, $value, $fail){
                if($value == AccountType::getKey(AccountType::Institution)){
                    $fail($attribute.' is required.');
                }
            }],
            'email'                => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'phone_number'         => ['required', 'string', 'email', 'max:191', Rule::unique('users')],
            'password'             => ['required', 'string', 'min:6', 'confirmed'],
            'timezone'             => ['required', 'timezone', 'max:191'],
            'nationality'          => ['required', 'string', 'max:191'],
            'referrer_code'        => ['required', 'string', 'min:6', 'max:191'],
            'last_login_ip'        => ['required', 'ip', 'max:191'],
        ];*/
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
