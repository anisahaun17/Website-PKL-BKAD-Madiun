<?php

namespace App\Http\Requests;

use App\Models\AssetDetail;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StoreSewaDetailRequest extends FormRequest
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
        try {
            $assetDetailId = $this->input('asset');
            $kode_transaksi = $this->input('kode_transaksi');

            $assetDetail = AssetDetail::findOrFail($assetDetailId);

            $max_jumlah = $assetDetail->jumlah_tersedia;
            $assetId = $assetDetail->asset_id;

            return [
                'kode_transaksi' => 'required|exists:sewas,kode_transaksi',
                'asset' => [
                    'required',
                    Rule::exists('asset_details', 'id')->where('asset_id', $assetId),
                    'unique:sewa_details,asset_detail_id,NULL,id,kode_transaksi,' . $kode_transaksi,
                ],
                'jumlah' => 'required|numeric|min:1|max:' . $max_jumlah,
            ];
        } catch (ModelNotFoundException $exception) {
            return [
                'kode_transaksi' => 'required|exists:sewas,kode_transaksi',
                'asset' => 'required',
                'jumlah' => 'required|numeric|min:1'
            ];
        }
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'kode_transaksi.required' => 'Kode transaksi wajib diisi.',
            'kode_transaksi.exists' => 'Kode transaksi tidak valid.',
            'asset.required' => 'Asset wajib diisi.',
            'asset.exists' => 'Asset tidak valid.',
            'asset.unique' => 'Asset detail sudah terdaftar untuk transaksi ini.',
            'jumlah.required' => 'Jumlah wajib diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal adalah 1.',
            'jumlah.max' => "Jumlah tidak boleh lebih dari :max.",
        ];
    }
}
