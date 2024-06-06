<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorejenisRequest extends FormRequest
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
        $kategori = request()->kategori;
        return [
            'nama' => [
                Rule::unique('jenis', 'nama')->where(function ($query) use ($kategori) {
                    return $query->where('kategori_id', $kategori);
                }),
                'required',
                'string',
                'max:255',
            ],
            'kategori' => 'required|exists:kategoris,id',
            'tarif' => 'required|numeric'
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
            'nama.unique' => 'Jenis sudah terdaftar.',
            'kategori.required' => 'Kolom kategori wajib diisi.',
            'kategori.exists' => 'Kategori yang dipilih tidak valid.',
            'tarif.required' => 'Kolom tarif wajib diisi.',
            'tarif.numeric' => 'Tarif harus berupa angka.',
        ];
    }
}
