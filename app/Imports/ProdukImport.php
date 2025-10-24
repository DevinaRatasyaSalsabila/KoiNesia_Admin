<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Collection;

class ProdukImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $file = request()->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        $gambarList = [];
        foreach ($worksheet->getDrawingCollection() as $drawing) {
            $koordinat = $drawing->getCoordinates();

            if ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\Drawing) {
                $path = $drawing->getPath();
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                $imageContents = file_get_contents($path);
            } elseif ($drawing instanceof \PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing) {
                ob_start();
                call_user_func($drawing->getRenderingFunction(), $drawing->getImageResource());
                $imageContents = ob_get_contents();
                ob_end_clean();
                $extension = $drawing->getMimeType() === 'image/png' ? 'png' : 'jpg';
            } else {
                continue; // lewati kalau bukan gambar
            }

            $filename = 'produk_' . time() . '_' . uniqid() . '.' . $extension;
            Storage::put('public/produk/' . $filename, $imageContents);

            preg_match('/\d+/', $koordinat, $match);
            $rowNumber = (int)$match[0];
            $gambarList[$rowNumber] = $filename;
        }

        foreach ($rows as $index => $row) {
            $barisExcel = $index + 2;
            $gambarFile = $gambarList[$barisExcel] ?? null;

            Produk::create([
                'kode_produk'      => $row['kode_produk'],
                'nama_produk'      => $row['nama_produk'],
                'harga_Satuan'     => $row['harga'],
                'deskripsi_produk' => $row['deskripsi_produk'],
                'ukuran_produk'    => $row['ukuran_produk'],
                'gambar_produk'    => $gambarFile,
            ]);
        }
    }
}
