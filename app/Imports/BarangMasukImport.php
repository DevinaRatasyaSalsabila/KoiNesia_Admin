<?php

namespace App\Imports;

use App\Models\BarangMasuk;
use App\Models\Pengeluaran;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarangMasukImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
        return new BarangMasuk([
            'kode_produk' => $row['kode_produk'],
            'total_produk' => $row['total_produk'],
            'tanggal' => $tanggal,
            'keterangan' => $row['keterangan'],
        ]);
    }

}