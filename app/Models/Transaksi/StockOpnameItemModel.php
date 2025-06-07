<?php

namespace App\Models\Transaksi;

use App\Models\Master\BarangModel;
use Illuminate\Database\Eloquent\Model;

class StockOpnameItemModel extends Model
{
    protected $table = 'stock_opname_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'opname_id',
        'barang_id',
        'quantity',
        'deskripsi',

    ];
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
}
