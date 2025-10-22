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
    <div class="label">
        <!-- BAGIAN KIRI -->
        <div class="left">
            <img class="logo" src="{{ asset('template/assets/images/projects/logo2.png') }}" alt="Azza Koi Farm Logo">

            <div class="social">
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png">Azzakoifarms</a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png">Azzakoifarms</a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111342.png">Azzakoifarms</a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png">Azzakoifarms</a>
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
                <p>No Resi :</p>
                <hr>
                <p>Penerima :</p>
                <hr>
                <p>No Penerima :</p>
                <hr>
                <p>Alamat :</p>
                <hr>
            </div>

            <div class="thanks">
                <p>Terima Kasih</p>
            </div>

            <div class="note">
                <span>N.B.</span> Wajib video saat unboxing paket, jika tidak ada video, ada masalah dengan ikan kami
                tidak bertanggung jawab.
            </div>
        </div>
    </div>
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
            box-sizing: border-box;
            padding: 10px;
            background-image: url('{{ asset('template/assets/images/cover.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-bottom: 15px;
        }

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

        .divider {
            width: 2px;
            background: white;
            border-radius: 1px;
            margin: 0 5px;
        }

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
    @foreach ($pesanan as $p)
        <div class="label">
            <!-- KIRI -->
            <div class="left">
                <img class="logo" src="{{ asset('template/assets/images/projects/logo2.png') }}" alt="Logo Azza">
                <div class="social">
                    <a href="#"><img
                            src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png">Azzakoifarms</a>
                    <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733585.png">081515725525</a>
                </div>
            </div>

            <!-- PEMBATAS -->
            <div class="divider"></div>

            <!-- KANAN -->
            <div class="right">
                <h1><span>Azza</span> Koi Farms</h1>
                <h3>Blitar - East Java</h3>

                @foreach ($pesanan as $item)
                    <div class="label">
                        <div class="right">
                            <div class="form-info">
                                <p>No Resi : {{ $item->kode_pesanan }}</p>
                                <p>Penerima : {{ $item->nama_pembeli }}</p>
                                <p>No Penerima : {{ $item->no_hp }}</p>
                                <p>Alamat : {{ $item->alamat }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="thanks">
                    <p>Terima Kasih</p>
                </div>

                <div class="note">
                    <span>N.B.</span> Wajib video saat unboxing paket.
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

</html>
