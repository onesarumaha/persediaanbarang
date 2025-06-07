<?php

namespace App\Http\Requests\Transaksi;

use Illuminate\Foundation\Http\FormRequest;

class StockOpnameRequest extends FormRequest
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
            'no_opname' =>'nullable',
            'user_id' => 'nullable',
            'tanggal' => 'required|date_format:Y-m-d',
            'deskripsi' => 'nullable',
            'status' => 'nullable|string',
            'stock_opname' => 'required|array',
            'stock_opname.*.barang_id' => 'required|exists:barang,id',
            'stock_opname.*.quantity' => 'required',
            'stock_opname.*.deskripsi' => 'nullable|string',
        ];
    }
}
