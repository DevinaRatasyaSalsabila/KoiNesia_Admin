<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
}
