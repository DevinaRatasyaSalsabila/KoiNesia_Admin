<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_pemasukan';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'kode_produk',
        'total_produk',
        'keterangan',
        'tanggal',
    ];
}