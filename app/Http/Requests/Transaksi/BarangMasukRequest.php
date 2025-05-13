<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class BarangMasukRequest extends FormRequest
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
            'no_transaksi' =>'nullable',
            'supplier_id' => 'nullable',
            'tanggal' => 'required|date_format:Y-m-d',
            'deskripsi' => 'nullable',
            'status' => 'nullable|string',
            'user_id' => 'nullable',
            'type' => 'nullable',
            'barang_items' => 'required|array',
            'barang_items.*.barang_id' => 'required|exists:barang,id',
            'barang_items.*.quantity' => 'required',
            'barang_items.*.deskripsi' => 'nullable|string',
        ];
    }
}
