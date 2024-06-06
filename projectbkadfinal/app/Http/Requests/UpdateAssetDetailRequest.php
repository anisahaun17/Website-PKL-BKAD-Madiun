<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetDetailRequest extends FormRequest
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
            'asset_id' => 'required|exists:assets,id',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'jumlah_asset' => 'required|numeric',
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
            'panjang.required' => 'Kolom Panjang wajib diisi.',
            'panjang.numerixc' => 'Kolom Panjang harus berupa angka.',
            'lebar.required' => 'Kolom Lebar wajib diisi.',
            'lebar.numerixc' => 'Kolom Lebar harus berupa angka.',
            'jumlah_asset.required' => 'Kolom Jumlah Asset wajib diisi.',
            'jumlah_asset.numerixc' => 'Kolom Jumlah Asset harus berupa angka.',
            'asset_id.required' => 'Asset ID tidak ditemukan.',
            'asset_id.exists' => 'Asset ID tidak ditemukan.',
        ];
    }
}
