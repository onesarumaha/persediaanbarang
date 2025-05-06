<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            DB::table('barang')->insert([
                'kode_barang' => 'BRG' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'nama_barang' => 'Barang ' . $i,
                'deskripsi' => 'Deskripsi barang ke-' . $i,
                'satuan' => 'pcs',
                'harga' => rand(10000, 500000),
                'stok' => rand(1, 100),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
