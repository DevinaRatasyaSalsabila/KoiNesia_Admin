<?php

namespace App\Imports;

use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangMasukImport implements ToCollection, WithHeadingRow
{
    public $kodeTidakDitemukan = []; 

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
            $produk = Produk::where('kode_produk', $row['kode_produk'])->first();

            if ($produk) {
                $produk->stok_produk += $row['total_produk'];
                $produk->save();

                BarangMasuk::create([
                    'kode_produk' => $row['kode_produk'],
                    'total_produk' => $row['total_produk'],
                    'tanggal' => $tanggal,
                    'keterangan' => $row['keterangan'],
                ]);
            } else {
                $this->kodeTidakDitemukan[] = $row['kode_produk'];
            }
        }
    }
}
