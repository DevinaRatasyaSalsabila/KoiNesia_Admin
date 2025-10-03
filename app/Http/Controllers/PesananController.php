<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function index()
    {
        $pembeli = Pembeli::all();
        $produk = Produk::all();
        $pesanan = DB::table('pesanan')
            ->leftJoin('pembeli', 'pesanan.id_pembeli', '=', 'pembeli.id_pembeli')
            ->select(
                'pesanan.kode_pesanan',
                'pesanan.id_pembeli',
                'pesanan.user_id',
                'pesanan.status',
                'pesanan.nominal',
                'pembeli.nama_pembeli as pembeli_nama',
                'pembeli.no_hp',
                'pembeli.alamat',
                'pesanan.created_at as pesanan_created_at'
            )
            ->where('pesanan.status', '!=', 'selesai')
            ->get();

        $pesanan = $pesanan->groupBy(function ($item) {
            if ($item->id_pembeli == 0) {
                return $item->pembeli_nama;
            } else {
                return $item->kode_pesanan . '_' . $item->id_pembeli . '_' . $item->user_id . '_' . $item->status . '_' . $item->nominal . '_' . $item->pembeli_nama . '_' . $item->no_hp . '_' . $item->alamat;
            }
        });

        $pesanan = $pesanan->map(fn($group) => $group->first());

        $pesanan->transform(function ($item) {
            $produk_detail = DB::table('pesanan')
                ->join('produk', 'pesanan.kode_produk', '=', 'produk.kode_produk')
                ->where('pesanan.kode_pesanan', $item->kode_pesanan)
                ->select('produk.nama_produk', 'produk.kode_produk', 'pesanan.jumlah')
                ->get();

            $item->produk_detail = $produk_detail;

            return $item;
        });

        return view('pesanan.index', compact('produk', 'pembeli', 'pesanan'));
    }

    public function show(string $kode)
    {
        $items = Pesanan::where('kode_pesanan', $kode)
            ->join('produk', 'pesanan.kode_produk', '=', 'produk.kode_produk')
            ->select(
                'produk.nama_produk',
                'produk.harga_Satuan',
                'pesanan.jumlah',
                'pesanan.nominal'
            )
            ->get();

        $pesanan = Pesanan::where('kode_pesanan', $kode)->firstOrFail();
        $pembeli = Pembeli::find($pesanan->id_pembeli);

        $totalKeseluruhan = $items->sum('nominal');

        return view('pesanan.modal.detail', compact('pesanan', 'pembeli', 'items', 'totalKeseluruhan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pesanan = Pesanan::where('kode_pesanan', $id)->firstOrFail();

        $status = $request->status;
        if (!in_array($status, ['baru', 'proses', 'selesai'])) {
            return response()->json(['error' => 'Status tidak valid'], 400);
        }

        $pesanan->status = $status;
        $pesanan->save();

        $pembeli = Pembeli::find($pesanan->id_pembeli);

        $no_hp = $pembeli->no_hp;
        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '+62' . substr($no_hp, 1);
        }

        // bikin isi pesan WA
        $pesan = "Halo *{$pembeli->nama_pembeli}*, saat ini pesanan dengan kode *{$pesanan->kode_pesanan}* statusnya sudah diupdate menjadi *{$status}* ya.\n\n"
            . "Terima kasih sudah order di Azza Koi Farm 🐟✨";

        // $this->apicall($no_hp, $pesan);

        return response()->json(['success' => true, 'status' => $pesanan->status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produk_ids = $request->input('produk', []);
        $jumlah     = $request->input('jumlah', []);

        $kodePesanan = 'PESN-' . date('dm') . '-' . date('Hi') . '-' . Str::upper(Str::random(3));

        $detailPesanan = "";
        $totalHarga    = 0;

        foreach ($produk_ids as $index => $idProduk) {
            $produk = Produk::find($idProduk);
            if (!$produk) continue;

            $qty = $jumlah[$index] ?? 1;
            $subtotal = $produk->harga_Satuan * $qty;
            $totalHarga += $subtotal;

            Pesanan::create([
                'kode_pesanan' => $kodePesanan,
                'id_pembeli'   => $request->id_pembeli,
                'user_id'      => 1,
                'status'       => 'baru',
                'kode_produk'  => $produk->kode_produk,
                'jumlah'       => $qty,
                'nominal'      => $subtotal,
            ]);

            $produk->stok_produk -= $qty;
            $produk->save();

            $detailPesanan .= "- {$produk->nama_produk} x{$qty} = Rp " . number_format($subtotal, 0, ',', '.') . "\n";
        }

        $pembeli = Pembeli::find($request->id_pembeli);
        $no_hp = $pembeli->no_hp;
        if (substr($no_hp, 0, 1) === '0') {
            $no_hp = '+62' . substr($no_hp, 1);
        }

        $pesan = "Halo *{$pembeli->nama_pembeli}*, terima kasih sudah order di Azza Koi Farm 🐟✨\n\n"
            . "Kode Pesanan: {$kodePesanan}\n\n"
            . "Detail pesanan kamu:\n"
            . $detailPesanan . "\n"
            . "Total: *Rp " . number_format($totalHarga, 0, ',', '.') . "*\n\n"
            . "Pesananmu saat ini sudah masuk dan akan segera diproses ya 👍";

        $this->apicall($no_hp, $pesan);

        return redirect()->route('pesanan.index');
    }

    private function apicall($no_hp, $pesan)
    {
        $client = new Client();
        $url = 'https://apiwa.smkpgriwlingi.sch.id/api/sendBulkMessage';

        $data = [
            'apiKey'  => 'f60d05297f0af62109d4ec9ec274bd32',
            'phone'   => json_encode([$no_hp]),
            'message' => $pesan,
            'delay'   => 1,
        ];

        try {
            $response = $client->post($url, ['form_params' => $data]);

            Log::info('WA API Response: ' . $response->getStatusCode());
            Log::info('WA API Body: ' . $response->getBody());
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $res = $e->getResponse();
                Log::error('WA API Error Status: ' . $res->getStatusCode());
                Log::error('WA API Error Body: ' . $res->getBody());
            } else {
                Log::error('WA API Error: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            Log::error('WA API Unknown Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $kode_pesanan)
    {
        $request->validate([
            'id_pembeli' => 'required|exists:pembeli,id_pembeli',
            'produk'     => 'required|array',
            'jumlah'     => 'required|array',
            'nominal'    => 'required|numeric',
        ]);

        DB::table('pesanan')->where('kode_pesanan', $kode_pesanan)->delete();

        foreach ($request->produk as $i => $kodeProduk) {
            $produk = DB::table('produk')->where('kode_produk', $kodeProduk)->first();
            if (!$produk) continue;

            $qty = $request->jumlah[$i] ?? 1;
            $subtotal = $produk->harga_Satuan * $qty;

            DB::table('pesanan')->insert([
                'kode_pesanan' => $kode_pesanan,
                'id_pembeli'   => $request->id_pembeli,
                'user_id'      => 1,
                'status'       => 'baru',
                'kode_produk'  => $kodeProduk,
                'jumlah'       => $qty,
                'nominal'      => $subtotal,
                'updated_at'   => now(),
                'created_at'   => now(),
            ]);
        }

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        Pesanan::where('kode_pesanan', $id)->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
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
}
