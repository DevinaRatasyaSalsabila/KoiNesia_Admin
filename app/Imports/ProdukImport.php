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

            $destinationPath = public_path('storage/produk/final');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            file_put_contents($destinationPath . '/' . $filename, $imageContents);

            preg_match('/\d+/', $koordinat, $match);
            $rowNumber = (int)$match[0];
            $gambarList[$rowNumber] = $filename;
        }

        Log::info('=== MULAI IMPORT PRODUK ===');
        Log::info('Total rows dibaca: ' . count($rows));

        foreach ($rows as $index => $row) {
            $barisExcel = $index + 2;
            $gambarFile = $gambarList[$barisExcel] ?? null;

            Log::info("Row #{$barisExcel}", $row->toArray());

            $hargaRaw = $row['harga_satuan'] ?? $row['harga'] ?? null;

            if ($hargaRaw === null) {
                Log::warning("Kolom harga tidak ditemukan di row #{$barisExcel}");
            }

            $hargaBersih = (int)preg_replace('/[^0-9]/', '', $hargaRaw);

            $isDuplicate = Produk::where('nama_produk', $row['nama_produk'] ?? null)
                ->where('ukuran_produk', $row['ukuran_produk'] ?? null)
                ->where('harga_satuan', $hargaBersih)
                ->exists();

            if ($isDuplicate) {
                Log::warning("⚠️ Duplikat terdeteksi di row #{$barisExcel}: {$row['nama_produk']} (ukuran {$row['ukuran_produk']}, harga {$hargaBersih})");
                continue;
            }
            Produk::create([
                'kode_produk'      => $row['kode_produk'] ?? null,
                'nama_produk'      => $row['nama_produk'] ?? null,
                'harga_satuan'     => $hargaBersih,
                'stok_produk'      => $row['stok_produk'] ?? 0,
                'deskripsi_produk' => $row['deskripsi_produk'] ?? null,
                'ukuran_produk'    => $row['ukuran_produk'] ?? null,
                'gambar_produk'    => json_encode([$gambarFile]),
            ]);
        }

        Log::info('=== SELESAI IMPORT PRODUK ===');
    }
}
