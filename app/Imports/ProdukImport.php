<?php

namespace App\Imports;

use App\Models\Pengeluaran;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdukImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {

        $tanggal = Date::excelToDateTimeObject($row['tanggal'])->format('Y-m-d');
        return new Pengeluaran([
            'nama_pengeluaran' => $row['nama_pengeluaran'],
            'tanggal' => $tanggal,
            'keterangan' => $row['keterangan'],
            'nominal' => $row['nominal'],
        ]);
    }

    // jika heading ada di baris selain 1 (misal baris 2), tambahkan method ini:
    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
