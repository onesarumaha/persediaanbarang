<?php

namespace App\Models\Transaksi;

use App\Http\Controllers\Master\BarangController;
use App\Models\Master\BarangModel;
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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            if ($model->barang_id) {
                BarangController::updateStock(
                    $model->barang_id, 
                    abs($model->quantity),
                    $model->id,
                    "Barang keluar: ID {$model->barang_id} berhasil di tambahkan",
                    'out',
                    'transaksi_item',

                );
                
            }
        });

        static::updating(function ($model) {
            $model->updated_at = now();  
            
            if ($model->barang_id) {
                BarangController::updateStock(
                    $model->barang_id, 
                    abs($model->quantity),
                    $model->id,
                    "Barang keluar: ID {$model->barang_id} berhasil di tambahkan",
                    'out',
                    'transaksi_item',

                );
                
            }
        });
    }


    public function barang() 
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }
}
