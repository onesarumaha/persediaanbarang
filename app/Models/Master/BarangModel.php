<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'deskripsi',
        'satuan',
        'harga',
        'stok'
    ];
    public $timestamps = true;
}
