<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Testing\Fluent\Concerns\Has;

class SupplierModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'suppliers';
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'no_telp',
        'email'
    ];

}
