<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_produk',
        'pembeli_id',
        'user_id',
        'status_pesanan',
        'nominal',
        'jumlah',
    ];
}
