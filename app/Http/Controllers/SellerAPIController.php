<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Produk;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SellerAPIController extends Controller
{
    public function index()
    {
        return response()->json(Produk::all());
    }

    public function pesan(Request $request)
    {
        $kode = [
            'no_hp' => $request->no_hp,
            'nama' => $request->nama,
            'jam' => now()->format('H:i'),
            'nomor_1' => $request->no_hp,
        ];

        $this->apicall($kode);

        return "Pesan terkirim ke " . $kode['no_hp'];
    }

    private function apicall($kode)
    {
        $client = new Client();

        $url = 'https://apiwa.smkpgriwlingi.sch.id/api/sendBulkMessage';

        $phone = json_encode([
            $kode['nomor_1'],
        ]);
        $data = [
            'apiKey' => 'f60d05297f0af62109d4ec9ec274bd32',
            'phone' => $phone,
            'message' =>
            "tes masuk ga :\n" .
                $kode['nama'] . "\n",
            'delay'   => 1

        ];

        try {
            $response = $client->post($url, [
                'form_params' => $data,
            ]);
        } catch (\Exception $e) {
            dd('Error: ' . $e->getMessage());
        }
    }

    public function reduceStock(Request $request, $id)
    {
        Log::info("Reduce stock dipanggil untuk ID: $id, data:", $request->all());

        $produk = Produk::where('kode_produk', $id)->first();

        if (!$produk) {
            Log::error("Produk tidak ditemukan dengan ID: $id");
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $qty = (int) $request->qty;

        if ($produk->stok_produk < $qty) {
            Log::warning("Stok tidak cukup untuk produk $id. Stok: {$produk->stok_produk}, diminta: $qty");
            return response()->json(['error' => 'Stok tidak cukup'], 400);
        }

        $produk->stok_produk -= $qty;
        $produk->save();

        Log::info("Stok produk $id berhasil dikurangi. Sisa: {$produk->stok_produk}");

        return response()->json([
            'message' => 'Stok updated',
            'sisa_stok' => $produk->stok_produk
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Log::info("API Pesanan Diterima:", $request->all());

            $pembeli = DB::table('pembeli')->where('no_hp', $request->telepon)->first();

            if (!$pembeli) {
                $idPembeli = DB::table('pembeli')->insertGetId([
                    'nama_pembeli' => $request->nama_pembeli,
                    'no_hp'        => $request->telepon,
                    'alamat'       => $request->alamat,
                    'created_at'   => now(),
                    'updated_at'   => now()
                ]);

                Log::info("Pembeli baru disimpan:", [
                    'id_pembeli'   => $idPembeli,
                    'nama_pembeli' => $request->nama_pembeli,
                    'no_hp'        => $request->telepon,
                    'alamat'       => $request->alamat,
                ]);
            } else {
                $idPembeli = $pembeli->id_pembeli;
                Log::info("Pembeli lama ditemukan:", (array) $pembeli);
            }

            // insert pesanan
            $pesanan = Pesanan::create([
                'kode_pesanan' => $request->kode_pesanan,
                'kode_produk'  => $request->kode_produk,
                'jumlah'       => $request->jumlah,
                'nominal'      => $request->nominal,
                'id_pembeli'   => $idPembeli,
                'status'       => 'baru',
                'user_id'      => 0,
            ]);

            Log::info("Pesanan berhasil disimpan:", $pesanan->toArray());

            DB::commit();

            return response()->json([
                'message' => 'Pesanan berhasil dibuat',
                'pembeli' => $pembeli,
                'pesanan' => $pesanan
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error("Gagal buat pesanan:", [
                'error_message' => $e->getMessage(),
                'trace'         => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
