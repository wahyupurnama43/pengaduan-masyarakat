<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengaduanRequest extends FormRequest
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
            'tujuan_aduan.required' => 'Field :attribute is required',
            'lokasi.required' => 'Field :attribute is required',
            'aduan.required' => 'Field :attribute is required',
            'gambar_aduan.required' => 'Field :attribute is required',
            'tgl_aduan.required' => 'Field :attribute is required',
        ];
    }

    public function rules(): array
    {
        return [
            'tujuan_aduan' => ['required', 'string'],
            'lokasi' => ['required', 'string'],
            'aduan' => ['required', 'string'],
            'gambar_aduan' => ['required', 'mimes:jpg,bmp,jpeg,png'],
            'tgl_aduan' => ['required', 'date'],
        ];
    }
}
