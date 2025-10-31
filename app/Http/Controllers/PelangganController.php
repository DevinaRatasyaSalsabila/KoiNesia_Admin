<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class PelangganController extends Controller
{
    public function beranda()
    {
        // $produk = DB::table('produk')->orderBy('created_at', 'desc')->get()->map(function ($item) {
        //     $gambarArray = json_decode($item->gambar_produk, true); // ubah JSON ke array
        //     $item->gambar_url = !empty($gambarArray)
        //         ? asset('storage/produk/final/' . $gambarArray[0]) // ambil gambar pertama
        //         : asset('files/images/default.jpg'); // fallback kalau kosong
        //     return $item;
        // });
        $produk = DB::table('produk')
            ->orderBy('created_at', 'desc') // urutkan dari yang terbaru
            ->take(4) // ambil hanya 4 produk teratas
            ->get()
            ->map(function ($item) {
                $gambarArray = json_decode($item->gambar_produk, true); // ubah JSON ke array
                $item->gambar_url = !empty($gambarArray)
                    ? asset('storage/produk/final/' . $gambarArray[0]) // ambil gambar pertama
                    : asset('files/images/default.jpg'); // fallback kalau kosong
                return $item;
            });


        return view('pelanggan.beranda.index', compact('produk'));
    }

    public function produk_lengkap()
    {
        $produk = DB::table('produk')->orderBy('created_at', 'desc')->get()->map(function ($item) {
            $gambarArray = json_decode($item->gambar_produk, true); // ubah JSON ke array
            $item->gambar_url = !empty($gambarArray)
                ? asset('storage/produk/final/' . $gambarArray[0]) // ambil gambar pertama
                : asset('files/images/default.jpg'); // fallback kalau kosong
            return $item;
        });
        return view('pelanggan.detail_produk.index', compact('produk'));
    }

    public function keranjang()
    {
        return view('pelanggan.keranjang.index');
    }

    public function format()
    {
        return view('pelanggan.format.index');
    }

    public function kirim(Request $request)
    {
        Log::info("Pesanan diterima dari pelanggan:", $request->all());

        $request->validate([
            'nama_pembeli' => 'required|string|max:100',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'produk' => 'required|array|min:1',
            'produk.*.id' => 'required|string',
            'produk.*.qty' => 'required|integer|min:1',
            'produk.*.harga' => 'required|integer|min:1',
        ]);

        $nama_pembeli = $request->nama_pembeli;
        $alamat = $request->alamat;
        $telepon = preg_replace('/\D/', '', $request->telepon);

        if (str_starts_with($telepon, '62')) {
            $telepon = '0' . substr($telepon, 2);
        } elseif (str_starts_with($telepon, '+62')) {
            $telepon = '0' . substr($telepon, 3);
        } elseif (!str_starts_with($telepon, '0')) {
            $telepon = '0' . $telepon;
        }

        Log::info("Nomor telepon setelah normalisasi:", ['telepon' => $telepon]);

        $pembeli = Pembeli::firstOrCreate(
            ['no_hp' => $telepon],
            [
                'nama_pembeli' => $nama_pembeli,
                'alamat' => $alamat,
            ]
        );

        Log::info("Data pembeli digunakan:", $pembeli->toArray());

        $kodePesanan = 'PESN-' . date('dm') . '-' . date('Hi') . '-' . Str::upper(Str::random(3));
        $totalHarga = 0;
        $detailPesanan = "";

        foreach ($request->produk as $p) {
            $nominal = $p['qty'] * $p['harga'];
            $totalHarga += $nominal;

            $detailPesanan .= "- {$p['nama']} ({$p['qty']}x) = Rp " . number_format($nominal, 0, ',', '.') . "\n";

            // 🧾 Simpan ke tabel pesanan
            Pesanan::create([
                "kode_pesanan" => $kodePesanan,
                "kode_produk"  => $p['id'],
                "jumlah"       => $p['qty'],
                "nominal"      => $nominal,
                "id_pembeli"   => $pembeli->id_pembeli,
                "user_id"      => auth()->id() ?? 1,
            ]);
        }

        $pesan = "Halo *{$pembeli->nama_pembeli}*, terima kasih sudah order di Azza Koi Farm 🐟✨\n\n"
            . "Kode Pesanan: *{$kodePesanan}*\n\n"
            . "Detail pesanan kamu:\n"
            . "{$detailPesanan}\n"
            . "Total: *Rp " . number_format($totalHarga, 0, ',', '.') . "*\n\n"
            . "Pesananmu sudah masuk dan akan segera diproses ya 👍";

        $this->apicall($telepon, $pesan);

        Log::info("Pesanan {$kodePesanan} berhasil dibuat dan dikirim ke WhatsApp.");

        return back()->with('success', 'Pesanan berhasil dikirim ke admin via WhatsApp!');
    }

    private function apicall($telepon, $pesan)
    {
        $client = new Client();
        $url = 'https://apiwa.smkpgriwlingi.sch.id/api/sendBulkMessage';

        $data = [
            'apiKey'  => env('WHAPI_KEY', 'f60d05297f0af62109d4ec9ec274bd32'),
            'phone'   => json_encode([$telepon]),
            'message' => $pesan,
            'delay'   => 1,
        ];

        try {
            Log::info('Data yang dikirim ke WA API:', $data);

            $response = $client->post($url, ['form_params' => $data]);
            Log::info('WA API response: ' . $response->getBody());
        } catch (\Exception $e) {
            Log::error('WA API error: ' . $e->getMessage());
        }
    }

    public function startService()
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://apiwa.smkpgriwlingi.sch.id/api/serviceStart';

        $data = [
            'apiKey' => env('WHAPI_KEY', 'f60d05297f0af62109d4ec9ec274bd32'),
        ];

        try {
            $response = $client->post($url, ['form_params' => $data]);
            $body = json_decode($response->getBody(), true);

            // log hasil
            Log::info('Service start response: ' . $response->getBody());

            // kalau sukses, bisa aja redirect sambil kasih pesan
            if (isset($body['code']) && $body['code'] == 200) {
                return back()->with('success', 'WA Service berhasil dihidupkan!');
            }

            return back()->with('error', 'Gagal start service: ' . $response->getBody());
        } catch (\Exception $e) {
            Log::error('Error starting WA service: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
