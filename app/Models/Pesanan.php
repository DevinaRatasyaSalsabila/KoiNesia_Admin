<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $guarded = [];
}
