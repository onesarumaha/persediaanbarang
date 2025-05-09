<?php

namespace App\Models\Transaksi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangKeluarItemModel extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi_item';
    protected $primaryKey = 'id';

    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'quantity',
        'deskripsi',
        'status',
        'type',
    ];
    public $timestamps = true;
}
