<?php

namespace App\Traits;

use App\Models\HistoryBarangModel;
use App\Models\Master\BarangModel;

trait HasStock
{
    public function updateStock($barangId, int $quantity, string $type, string $description, $transaksiId = null)
    {
        $barang = BarangModel::find($barangId);
        if (!$barang) return;

        $stokAwal = $barang->stock;
        $stokAkhir = $type === 'IN' ? $stokAwal + $quantity : $stokAwal - $quantity;

        if ($type === 'OUT' && $stokAkhir < 0) {
            throw new \Exception("Stok tidak mencukupi untuk barang ID {$barangId}");
        }

        $barang->stock = $stokAkhir;
        $barang->save();

        HistoryBarangModel::create([
            'barang_id'    => $barang->id,
            'quantity'     => $quantity,
            'type'         => $type,
            'stok_awal'    => $stokAwal,
            'stok_akhir'   => $stokAkhir,
            'description'  => $description,
            'parent_id' => $transaksiId,
        ]);
    }
}
