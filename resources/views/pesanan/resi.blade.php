{{-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azza Koi Farm - Label Pengiriman</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .label {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            border: 3px solid black;
            width: 14cm;
            height: 7cm;
            margin-top: 15px;
            box-sizing: border-box;
            padding: 10px;
            background-image: url('{{ asset('template/assets/images/cover.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* KIRI */
        .left {
            width: 33%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            text-align: center;
        }

        .left img.logo {
            width: 90px;
            margin-bottom: 5px;
        }

        .social {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 10px;
        }

        .social a {
            color: black;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: bold;
        }

        .social img {
            width: 12px;
            height: 12px;
        }

        /* PEMBATAS */
        .divider {
            width: 2px;
            background: white;
            border-radius: 1px;
            margin: 0 5px;
        }

        /* KANAN */
        .right {
            width: 65%;
            padding: 5px 10px;
            position: relative;
            color: white;
        }

        .right h1 {
            font-size: 20px;
            text-transform: uppercase;
            margin: 0;
            text-shadow: 1px 1px 2px black;
        }

        .right h1 span {
            color: red;
        }

        .right h3 {
            font-size: 12px;
            margin-top: -2px;
            color: white;
        }

        .form-info {
            margin-top: 12px;
            font-size: 11px;
            color: black;
            font-weight: bold;
        }

        .form-info p {
            margin: 12px 0 4px;
        }

        .form-info hr {
            border: 0;
            border-bottom: 1px solid black;
            margin-bottom: 5px;
        }

        .thanks {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        .thanks p {
            font-size: 18px;
            font-weight: 800;
            color: rgb(230, 12, 12);
            border-bottom: 2px solid rgb(41, 40, 40);
            display: inline-block;
            padding-bottom: 2px;
            letter-spacing: 1px;
        }

        .note {
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            font-size: 8px;
            color: white;
            text-align: center;
        }

        .note span {
            color: red;
            font-weight: bold;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    @foreach ($pesanan as $item)
        <div class="label">
            <!-- BAGIAN KIRI -->
            <div class="left">
                <img class="logo" src="{{ asset('template/assets/images/projects/logo2.png') }}"
                    alt="Azza Koi Farm Logo">

                <div class="social">
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png">Azzakoifarms</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png">Azzakoifarms</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111342.png">Azzakoifarms</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png">Azzakoifarms</a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">089562227329</a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">081515725525</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/732/732200.png">azzaaidakhmad@gmail.com</a>
                </div>
            </div>

            <!-- PEMBATAS -->
            <div class="divider"></div>

            <!-- BAGIAN KANAN -->
            <div class="right">
                <h1><span>Azza</span> Koi Farms</h1>
                <h3>Blitar - East Java</h3>

                <div class="form-info">
                    <p>No Pesanan : {{ $item->kode_pesanan }}</p>
                    <hr>
                    <p>Penerima : {{ $item->nama_pembeli }}</p>
                    <hr>
                    <p>No Penerima : {{ $item->no_hp }}</p>
                    <hr>
                    <p>Alamat : {{ $item->alamat }}</p>
                    <hr>
                </div>

                <div class="thanks">
                    <p>Terima Kasih</p>
                </div>

                <div class="note">
                    <span>N.B.</span> Wajib video saat unboxing paket, jika tidak ada video, ada masalah dengan ikan
                    kami
                    tidak bertanggung jawab.
                </div>
            </div>
        </div>
    @endforeach
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azza Koi Farm - Label Pengiriman</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: 'Poppins', sans-serif;
            background: #fff;
        }

        .label {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            border: 2px solid black;
            width: 14cm;
            min-height: 7cm;
            margin: 0 auto 15px auto;
            padding: 10px;
            background-image: url('{{ asset('template/assets/images/cover.png') }}');
            background-size: cover;
            background-position: center;
            color: black;
            box-sizing: border-box;
            position: relative;
            overflow: hidden;
        }

        .left {
            width: 32%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            gap: 4px;
            text-align: center;
        }

        .left img.logo {
            width: 85px;
            margin-bottom: 6px;
        }

        .social {
            display: flex;
            flex-direction: column;
            gap: 3px;
            font-size: 9px;
        }

        .social a {
            color: black;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
        }

        .social img {
            width: 10px;
            height: 10px;
        }

        .divider {
            width: 1px;
            background: #fff;
            margin: 0 5px;
        }

        .right {
            width: 65%;
            color: black;
            font-size: 11px;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .right h1 {
            font-size: 18px;
            margin: 0;
            text-shadow: 1px 1px 2px black;
            text-transform: uppercase;
        }

        .right h1 span {
            color: red;
        }

        .right h3 {
            margin: 2px 0 8px;
            font-size: 11px;
            color: white;
        }

        .form-info p {
            margin: 3px 0;
            font-weight: 600;
        }

        .form-info hr {
            margin: 4px 0;
            border: none;
            border-bottom: 1px solid black;
        }

        .produk-list {
            margin-top: 6px;
            flex-grow: 1;
            overflow-y: auto;
            max-height: 4cm;
        }

        .produk-list table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5px;
        }

        .produk-list th,
        .produk-list td {
            border: 1px solid black;
            padding: 3px;
            text-align: center;
        }

        .produk-list th {
            background: rgba(139, 136, 136, 0.8);
            font-weight: bold;
        }

        .thanks {
            text-align: center;
            margin-top: 5px;
        }

        .thanks p {
            font-size: 14px;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
        }

        .note {
            font-size: 8px;
            color: white;
            text-align: center;
            margin-top: 2px;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .produk-list {
                overflow: visible;
            }
        }
    </style>
</head>

<body>
    @foreach ($pesanan as $kodePesanan => $items)
        <div class="label">
            <!-- BAGIAN KIRI -->
            <div class="left">
                <img class="logo" src="{{ asset('template/assets/images/projects/logo2.png') }}"
                    alt="Azza Koi Farm Logo">
                <div class="social">
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png">Azzakoifarms</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png">Azzakoifarms</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111342.png">Azzakoifarms</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png">Azzakoifarms</a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">089562227329</a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">081516725525</a>
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/732/732200.png">azzaaidakhmad@gmail.com</a>
                </div>
            </div>

            <!-- PEMBATAS -->
            <div class="divider"></div>

            <!-- BAGIAN KANAN -->
            <div class="right">
                <div>
                    <h1><span>Azza</span> Koi Farms</h1>
                    <h3>Blitar - East Java</h3>

                    <div class="form-info">
                        <p>No Pesanan : {{ $kodePesanan }}</p>
                        <hr>
                        <p>Penerima : {{ $items->first()->nama_pembeli }}</p>
                        <hr>
                        <p>No Penerima : {{ $items->first()->no_hp }}</p>
                        <hr>
                        <p>Alamat : {{ $items->first()->alamat }}</p>
                        <hr>
                    </div>
                </div>

                <div class="produk-list">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $produk)
                                <tr>
                                    <td>{{ $produk->nama_produk }}</td>
                                    <td>{{ $produk->jumlah }}</td>
                                    <td>Rp{{ number_format($produk->harga_satuan * $produk->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <div class="thanks">
                        <p>Terima Kasih</p>
                    </div>
                    <div class="note">
                        <span style="color: red">N.B.</span> Wajib video saat unboxing paket, jika tidak ada video, kami
                        tidak bertanggung jawab.
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        window.onload = function() {
            window.print();
        };
        window.onafterprint = function() {
            window.location.href = "{{ route('pesanan.index') }}";
        };
    </script>
</body>

</html>
