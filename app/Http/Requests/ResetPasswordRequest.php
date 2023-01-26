<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'password' => ['required','confirmed',Password::min(8)->letters()->numbers()->mixedCase()]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
