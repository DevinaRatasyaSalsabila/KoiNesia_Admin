<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = 'pembeli';
    protected $primaryKey = 'id_pembeli';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_pembeli',
        'alamat',
        'no_hp',
    ];
}
