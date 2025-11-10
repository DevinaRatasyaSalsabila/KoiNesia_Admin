<?php

namespace App\Imports;

use App\Models\Produk;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProdukImport implements ToCollection, WithHeadingRow
{
    protected $skippedEmpty = [];
    protected $skippedDuplicate = [];

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
            $hargaBersih = $hargaRaw ? (int)preg_replace('/[^0-9]/', '', $hargaRaw) : null;

            // data wajib
            $requiredFields = [
                'kode_produk'   => $row['kode_produk'] ?? null,
                'nama_produk'   => $row['nama_produk'] ?? null,
                'ukuran_produk' => $row['ukuran_produk'] ?? null,
                'harga_satuan'  => $hargaBersih,
                'gambar_produk' => $gambarFile ?? null,
            ];

            // kalau ada data kosong
            if (in_array(null, $requiredFields, true) || $hargaBersih === 0) {
                $this->skippedEmpty[] = $barisExcel;
                Log::warning("⚠️ Row #{$barisExcel} diskip karena data wajib kosong", $requiredFields);
                continue;
            }

            // kalau duplikat
            $isDuplicate = Produk::where('nama_produk', $row['nama_produk'])
                ->where('ukuran_produk', $row['ukuran_produk'])
                ->where('harga_satuan', $hargaBersih)
                ->exists();

            if ($isDuplicate) {
                $this->skippedDuplicate[] = $barisExcel;
                Log::warning("⚠️ Duplikat di row #{$barisExcel}: {$row['nama_produk']} ({$row['ukuran_produk']})");
                continue;
            }

            Produk::create([
                'kode_produk'      => $row['kode_produk'],
                'nama_produk'      => $row['nama_produk'],
                'harga_satuan'     => $hargaBersih,
                'stok_produk'      => $row['stok_produk'] ?? 0,
                'deskripsi_produk' => $row['deskripsi_produk'] ?? null,
                'ukuran_produk'    => $row['ukuran_produk'],
                'gambar_produk'    => json_encode([$gambarFile]),
            ]);
        }

        Log::info('=== SELESAI IMPORT PRODUK ===');
    }

    public function getSkippedEmpty()
    {
        return $this->skippedEmpty;
    }

    public function getSkippedDuplicate()
    {
        return $this->skippedDuplicate;
    }
}
