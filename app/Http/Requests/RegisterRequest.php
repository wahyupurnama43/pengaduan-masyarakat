<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email.unique'       => 'Given :attribute is already exists',
            'password.required'  => 'Field :attribute is required',
            'password.string'    => 'Given invalid :attribute',
            'password.min'       => 'Given :attribute is to short, need to be at least :min characters',
            'password.confirmed' => 'Given :The Password field confirmation does not match',
            'nama.required'      => 'Field :attribute is required',

        ];
    }

    public function rules(): array
    {
        return [
            'email'                 => ['required', 'email', 'unique:users,email', 'bail'],
            'password'              => ['required', 'string', 'min:8', 'bail', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'nama'                  => ['required', 'string'],
            'role'                  => ['string'],
        ];
    }
}
