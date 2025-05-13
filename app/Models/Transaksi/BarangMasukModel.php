<?php

namespace App\Models\Transaksi;

use App\Models\Master\BarangModel;
use App\Models\Master\SupplierModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BarangMasukModel extends Model
{
    use SoftDeletes;

    const PREFIX_STATUS = "TR";
    const STATUS_DONE = "TR-DONE";

    protected $table = 'transaksi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_transaksi',
        'supplier_id',
        'deskripsi',
        'tanggal',
        'status',
        'type',
        'user_id'

    ];
    public $timestamps = true;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
            $model->created_at = now();
            $model->status = self::STATUS_DONE;
            $model->type = 'OUT';
    
            $latestInvoice = self::latest('id')->first();
            $nextId = $latestInvoice ? $latestInvoice->id + 1 : 1;
            $model->no_transaksi = 'TR-' . $nextId;
        });
    
        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }


    public function barangMasukItems()
    {
        return $this->hasMany(BarangMasukItemModel::class, 'transaksi_id');
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id');
    }
}
