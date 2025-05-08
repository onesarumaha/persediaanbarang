<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoryBarangModel extends Model
{
    protected $table = 'history_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'barang_id',
        'user_id',
        'parent_id',
        'stock_awal',
        'quantity',
        'stock_akhir',
        'note',
        'from',
        'type',

    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
            $model->created_at = now();
        });
    
       
    }
}
