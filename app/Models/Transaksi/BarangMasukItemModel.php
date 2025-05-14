<?php

namespace App\Models\Transaksi;

use App\Http\Controllers\Master\BarangController;
use App\Models\Master\BarangModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BarangMasukItemModel extends Model
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
                    "Barang masuk: ID {$model->barang_id} berhasil di tambahkan",
                    'in',
                    'transaksi_item',

                );
                
            }
        });

        static::updating(function ($model) {
            $model->updated_at = now();  
            
            if ($model->barang_id) {
                BarangController::updateStock(
                    $model->barang_id, 
                    $model->quantity,     
                    'Transaksi',    
                    'in',                 
                    $model->invoice_id,  
                    "Invoice ID {$model->invoice_id} item has been updated"
                );
            }
        });
    }

    public function barang() 
    {
        return $this->belongsTo(BarangModel::class, 'barang_id');
    }

    public function barangMasuk() 
    {
        return $this->belongsTo(BarangMasukModel::class, 'transaksi_id');
    }
}
