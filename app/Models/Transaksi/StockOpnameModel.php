<?php

namespace App\Models\Transaksi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class StockOpnameModel extends Model
{
    const PREFIX_STATUS = "OP";
    const STATUS_PENDING = "OP-PENDING";
    const STATUS_DONE = "OP-DONE";

    protected $table = 'stock_opname';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_opname',
        'user_id',
        'deskripsi',
        'tanggal',
        'status',

    ];
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
            $model->created_at = now();
            $model->status = self::STATUS_PENDING;
    
            $latestInvoice = self::latest('id')->first();
            $nextId = $latestInvoice ? $latestInvoice->id + 1 : 1;
            $model->no_opname = 'OP-' . $nextId;
        });
    
        static::updating(function ($model) {
            $model->updated_at = now();
        });
    }

    public function stockOpnameItems()
    {
        return $this->hasMany(StockOpnameItemModel::class, 'opname_id');
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
