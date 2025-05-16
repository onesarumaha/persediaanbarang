<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class SatuanModel extends Model
{
    protected $table = 'satuan';
    protected $fillable = ['satuan'];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany(BarangModel::class, 'satuan_id');
    }
}
