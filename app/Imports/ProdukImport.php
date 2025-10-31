<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProdukImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $file = request()->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        $gambarList = [];

        // 🔹 Ambil gambar dari Excel
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
                continue;
            }

            $filename = 'produk_' . uniqid() . '.' . $extension;

            // ✅ Simpan ke public/storage/produk/final
            $destinationPath = public_path('storage/produk/final');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            file_put_contents($destinationPath . '/' . $filename, $imageContents);

            preg_match('/\d+/', $koordinat, $match);
            $rowNumber = (int)$match[0];
            $gambarList[$rowNumber] = $filename;
        }

        // 🔹 Logging isi baris yang dibaca dari Excel
        Log::info('=== MULAI IMPORT PRODUK ===');
        Log::info('Total rows dibaca: ' . count($rows));

        foreach ($rows as $index => $row) {
            $barisExcel = $index + 2;
            $gambarFile = $gambarList[$barisExcel] ?? null;

            // 🔹 Log tiap baris buat debug
            Log::info("Row #{$barisExcel}", $row->toArray());

            // 🧮 Ambil kolom harga (sesuai heading kamu di Excel)
            $hargaRaw = $row['harga_satuan'] ?? $row['harga'] ?? null;

            // Jika null, log error-nya
            if ($hargaRaw === null) {
                Log::warning("Kolom harga tidak ditemukan di row #{$barisExcel}");
            }

            // 🧽 Bersihkan harga: "IDR 90,000" -> 90000
            $hargaBersih = (int)preg_replace('/[^0-9]/', '', $hargaRaw);

            Produk::create([
                'kode_produk'      => $row['kode_produk'] ?? null,
                'nama_produk'      => $row['nama_produk'] ?? null,
                'harga_Satuan'     => $hargaBersih,
                'stok_produk'      => $row['stok_produk'] ?? 0,
                'deskripsi_produk' => $row['deskripsi_produk'] ?? null,
                'ukuran_produk'    => $row['ukuran_produk'] ?? null,
                'gambar_produk' => json_encode([$gambarFile]),
            ]);
        }

        Log::info('=== SELESAI IMPORT PRODUK ===');
    }
}
