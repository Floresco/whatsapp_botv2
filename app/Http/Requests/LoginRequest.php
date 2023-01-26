<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phone_email' => ['required', 'string', 'min:6'],
            'password' => ['required','string',Password::min(8)->mixedCase()->letters()->numbers()]
        ];
    }

    /*
    protected function failedValidation(Validator $validator)
    {
        $response = new Response(['errors' => $validator->errors()->all()], 200);
        throw new ValidationException($validator,$response);
    }
    */
}
