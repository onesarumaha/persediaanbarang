<?php

namespace App\Models\Laporan;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    public $timestamps = false;

    protected $fillable = [
        'id_laporan',
        'judul',
        'isi',
        'tanggal',
        'status',
        'id_user'
    ];

    // Define any relationships if necessary
    // For example, if Laporan belongs to a User:
    // public function user() {
    //     return $this->belongsTo(User::class, 'id_user');
    // }
    // Define any additional methods or scopes if necessary
}
