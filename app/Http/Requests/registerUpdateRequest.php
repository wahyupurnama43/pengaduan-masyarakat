<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registerUpdateRequest extends FormRequest
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
            'password.min'       => 'Given :attribute is to short, need to be at least :min characters',
            'nama.required'      => 'Field :attribute is required',
        ];
    }

    public function rules(): array
    {
        return [
            'email'                 => ['required', 'email', 'bail'],
            'nama'                  => ['required', 'string'],
            'role'                  => ['string'],
        ];
    }
}
