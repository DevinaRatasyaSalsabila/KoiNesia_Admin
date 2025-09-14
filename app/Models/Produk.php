<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $guarded = [];

    protected $appends = ['gambar_url'];

    public function getGambarUrlAttribute()
    {
        $gambarnya = $this->gambar_produk;

        if ($this->isJson($gambarnya)) {
            $arr = json_decode($gambarnya, true);
            $gambarnya = $arr[0] ?? null;
        }

        if ($gambarnya) {
            return asset('storage/produk/final/' . $gambarnya);
        }
        return null;
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}
