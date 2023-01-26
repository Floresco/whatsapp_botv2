<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_profil_id' => ['required', 'uuid', Rule::exists('user_profils', 'id')],
            'firstname' => ['required', 'string', 'alpha', 'min:2'],
            'lastname' => ['required', 'string', 'alpha', 'min:2'],
            'phone' => ['required', 'numeric', 'digits:8'],
            'email' => ['required', 'email:rfc,dns'],
            'key' => ['prohibits:password', 'nullable', 'uuid', 'exists:users,id'],
            'password' => ['prohibits:key', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
