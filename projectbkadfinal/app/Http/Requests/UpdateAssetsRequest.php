<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetsRequest extends FormRequest
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
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|exists:kategoris,id',
            'jenis' => [
                'required',
                Rule::exists('jenis', 'id')->where('kategori_id', $this->input('kategori')),
                Rule::unique('assets', 'jenis_id')->where(function ($query) {
                    return $query->where('nama', $this->input('nama'))
                        ->where('lokasi', $this->input('lokasi'));
                })->ignore($this->route('assets')->id),
            ]
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
            'nama.required' => 'Kolom Nama wajib diisi.',
            'nama.string' => 'Kolom Nama harus berupa teks.',
            'nama.max' => 'Kolom Nama tidak boleh lebih dari :max karakter.',
            'lokasi.required' => 'Kolom Lokasi wajib diisi.',
            'lokasi.string' => 'Kolom Lokasi harus berupa teks.',
            'lokasi.max' => 'Kolom Lokasi tidak boleh lebih dari :max karakter.',
            'lokasi.unique' => 'Lokasi ini sudah digunakan untuk kategori yang sama.',
            'kategori.required' => 'Kolom Kategori wajib diisi.',
            'kategori.exists' => 'Pilihan Kategori tidak valid.',
            'jenis.required' => 'Kolom Jenis wajib diisi.',
            'jenis.exists' => 'Pilihan Jenis tidak valid untuk Kategori yang dipilih.',
            'jenis.unique' => 'Asset sudah tedaftar.',
        ];
    }
}
