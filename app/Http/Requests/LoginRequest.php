<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'email.required'     => 'Field :attribute is required',
            'email.email'        => 'Given invalid :attribute',
            'password.required'  => 'Field :attribute is required',
            'password.min'       => 'Given :attribute is to short, need to be at least :min characters',

        ];
    }

    public function rules(): array
    {
        return [
            'email'                 => ['required', 'email', 'bail'],
            'password'              => ['required', 'string', 'min:8'],
        ];
    }
}
