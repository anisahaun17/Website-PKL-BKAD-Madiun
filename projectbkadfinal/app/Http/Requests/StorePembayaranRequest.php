<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
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
            'tanggal_pembayaran' => 'required|date',
            'petugas' => 'required|exists:petugas,id'
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
            'tanggal_pembayaran.required' => 'Kolom Tanggal Sewa harus diisi.',
            'tanggal_pembayaran.date' => 'Kolom Tanggal Sewa harus berupa tanggal.',
            'petugas.required' => 'Kolom petugas harus diisi.',
            'petugas.exists' => 'Petugas yang dipilih tidak valid.',
        ];
    }
}
