<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSewaRequest extends FormRequest
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
            'asset' => 'required|exists:assets,id',
            'nama' => 'required|string|max:255',
            'telepon' => 'required|regex:/^\d+$/|max:16',
            'npwr' => 'required|regex:/^\d+$/|max:20',
            'nik' => 'required|regex:/^\d{16}$/',
            'alamat' => 'required|string|max:266',
            'tgl_sewa_mulai' => 'required|date|after_or_equal:today',
            'lama_sewa' => 'required|numeric',
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
            'asset.required' => 'Kolom Asset harus diisi.',
            'asset.exists' => 'Asset yang dipilih tidak valid.',
            'nama.required' => 'Kolom Nama harus diisi.',
            'nama.string' => 'Kolom Nama harus berupa teks.',
            'nama.max' => 'Kolom Nama tidak boleh lebih dari :max karakter.',
            'telepon.required' => 'Kolom Telepon harus diisi.',
            'telepon.regex' => 'Format Telepon tidak valid. Gunakan hanya angka.',
            'telepon.max' => 'Kolom Telepon tidak boleh lebih dari :max karakter.',
            'npwr.required' => 'Kolom NPWR harus diisi.',
            'npwr.regex' => 'Format NPWR tidak valid. Gunakan hanya angka.',
            'npwr.max' => 'Kolom NPWR tidak boleh lebih dari :max karakter.',
            'nik.required' => 'Kolom NIK harus diisi.',
            'nik.regex' => 'Format NIK tidak valid. Gunakan 16 digit angka.',
            'alamat.required' => 'Kolom Alamat harus diisi.',
            'alamat.string' => 'Kolom Alamat harus berupa teks.',
            'alamat.max' => 'Kolom Alamat tidak boleh lebih dari :max karakter.',
            'tgl_sewa_mulai.required' => 'Kolom Tanggal Sewa harus diisi.',
            'tgl_sewa_mulai.date' => 'Kolom Tanggal Sewa harus berupa tanggal.',
            'tgl_sewa_mulai.after_or_equal' => 'Kolom Tanggal Sewa harus tanggal sekarang atau setelahnya.',
            'lama_sewa.required' => 'Kolom Lama Sewa harus diisi.',
            'lama_sewa.numeric' => 'Kolom Lama Sewa harus berupa angka.',
        ];
    }
}
