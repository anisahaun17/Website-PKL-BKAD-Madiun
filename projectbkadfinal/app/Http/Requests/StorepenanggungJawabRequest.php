<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepenanggungJawabRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nip' => [
                'required',
                'regex:/^\d{18}$/',
                'unique:penanggung_jawabs,nip'
            ],
            'jabatan' => 'required|exists:jabatans,id',
            'status' => 'required|in:Aktif,Non Aktif',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Kolom nama wajib diisi.',
            'nama.string' => 'Kolom nama harus berupa teks.',
            'nama.max' => 'Kolom nama tidak boleh melebihi 255 karakter.',
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.regex' => 'Format NIP tidak valid. NIP harus terdiri dari 18 digit angka.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'jabatan.required' => 'Kolom jabatan wajib dipilih.',
            'jabatan.exists' => 'Jabatan yang dipilih tidak valid.',
            'status.required' => 'Kolom status wajib diisi.',
            'status.in' => 'Status harus berupa "Aktif" atau "Non Aktif".',
        ];
    }
}
