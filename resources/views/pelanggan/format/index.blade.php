@extends('pelanggan.mainPelanggan')
@section('content')
    @push('style')
        <style>
            /* 🌸 Responsive Layout Cart Page */
            @media (max-width: 768px) {

                /* Sembunyiin header tabel biar rapih di mobile */
                #myTable thead {
                    display: none;
                }

                #myTable tbody tr {
                    display: flex;
                    flex-direction: column;
                    border: 1px solid #ddd;
                    border-radius: 10px;
                    margin-bottom: 15px;
                    padding: 10px;
                    background-color: #fff;
                    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
                }

                #myTable td {
                    display: block;
                    width: 100%;
                    border: none !important;
                    padding: 5px 0 !important;
                }

                /* 🔹 Produk */
                .cart-product-desc {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                .cart-product-desc img {
                    width: 70px;
                    height: 70px;
                    border-radius: 10px;
                    object-fit: cover;
                }

                .cart-product-desc h5 {
                    font-size: 1rem;
                    margin-bottom: 2px;
                }

                .cart-product-desc p {
                    font-size: 0.85rem;
                    color: #777;
                }

                /* 🔹 Harga dan Qty jadi 1 baris */
                .cart-price-qty {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-top: 8px;
                    font-size: 0.95rem;
                }

                .cart-price-qty h5 {
                    margin: 0;
                    font-weight: 600;
                }

                .cart-price-qty .qty {
                    background: #f1f1f1;
                    color: #333;
                    padding: 4px 8px;
                    border-radius: 8px;
                }

                /* 🔹 Total */
                .cart-total {
                    text-align: right;
                    margin-top: 5px;
                    font-weight: 600;
                }
            }
        </style>
    @endpush

    <div id="cart-page" class="page-hero-section division">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="text-center hero-txt white-color">
                        <div id="breadcrumb">
                            <div class="row">
                                <div class="col">
                                    <div class="breadcrumb-nav">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item">
                                                    <a href="demo-1.html">Pesanan</a>
                                                </li>
                                                <li class="breadcrumb-item active" aria-current="page">
                                                    Keranjang
                                                </li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <h2 class="h2-xl"> Pesanan</h2> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('pesanan.kirim') }}" method="POST" class="row" enctype="multipart/form-data">
        @csrf
        <section class="wide-100 cart-page division">
            <div class="container">
                <div class="row" style="margin-bottom: 50px">
                    <div class="col-lg-12">
                        <div class="card  text-light" style="background-color: #be170b">
                            <div class="card-body">
                                <p>
                                    <i class="bi bi-info-circle-fill"></i>
                                    Semua pesanan akan diproses berdasarkan urutan antrian. Kami berkomitmen memproses dan
                                    mengirimkan pesanan secepat mungkin sesuai jadwal yang telah ditetapkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-5 rounded bg-body-tertiary">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-holder">
                                        <div class="row">
                                            <div class="mb-2 col-md-12 col-lg-6">
                                                <label for="">Nama Penerima</label>
                                                <input type="text" name="nama_pembeli" class="form-control "
                                                    placeholder="Masukkan Nama Penerima" required>
                                            </div>

                                            <div class="col-md-12 col-lg-6">
                                                <label for="">Nomor HP Penerima</label>
                                                <div class="mb-3 input-group">
                                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                                    <input type="" class="form-control" placeholder="8576880937"
                                                        name="telepon" aria-label="Masukkan Nomor Telepon"
                                                        aria-describedby="basic-addon1" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="margin-bottom:20px;">
                                            <label>Provinsi</label><br>
                                            <select class="form-control" id="province" name="province_id">
                                                <option value="">-- Pilih Provinsi --</option>
                                                @foreach ($provinces as $province)
                                                    <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-12 col-lg-6">
                                                <label>Kota / Kabupaten</label><br>
                                                <select class="form-control" id="city" name="city_id">
                                                    <option value="">-- Pilih Kota / Kabupaten --</option>
                                                </select>
                                            </div>

                                            <div class="mb-2 col-md-12 col-lg-6">
                                                <label>Kecamatan</label><br>
                                                <select class="form-control" id="district" name="district_id">
                                                    <option value="">-- Pilih Kecamatan --</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-2 col-md-12 col-lg-12">
                                            <label for="">Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control " placeholder="Masukkan Alamat Lengkap" required></textarea>
                                        </div>

                                        {{-- <div style="margin-bottom:20px;">
                                            <label>Berat (gram)</label><br> --}}
                                        <input class="form-control hidden" type="hidden" id="weight" name="weight"
                                            min="1" placeholder="cth: 1000">
                                        {{-- </div> --}}

                                        <div style="margin-bottom:20px;">
                                            <label>Pilih Kurir</label><br>
                                            <label><input type="radio" name="courier" value="jne"> JNE</label><br>
                                            <label><input type="radio" name="courier" value="jnt"> J&T</label><br>
                                        </div>

                                        <button id="btn-cek-ongkir" style="display:none">Hitung Ongkos Kirim</button>

                                        <div id="loading" style="display:none; margin-top:15px;">
                                            <b>Sedang menghitung ongkir...</b>
                                        </div>

                                        <div id="results"
                                            style="display:none; margin-top:20px; border:1px solid #ccc; padding:15px;">
                                            <h3>Hasil Ongkos Kirim</h3>
                                            <div id="result-list"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <section id="cart-1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="cart-table mb-70">
                                            <table id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Produk</th>
                                                        <th scope="col">Harga</th>
                                                        <th scope="col">Item</th>
                                                        <th scope="col" class="text-center">Total</th>
                                                        {{-- <th scope="col" class="text-end">Hapus</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- isi keranjang diisi lewat JS -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <table>
                                    <thead>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-end">
                                                <h5 class="h5-md">Total Harga Barang :</h5>
                                            </td>
                                            <td>
                                                <h5 id="total-barang" class="text-center h5-md">Rp 0</h5>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="3"></td>
                                            <td class="text-end">
                                                <h5 class="h5-md">Ongkir :</h5>
                                            </td>
                                            <td>
                                                <h5 id="total-ongkir" class="text-center h5-md">Rp 0</h5>
                                            </td>
                                        </tr>

                                        {{-- <tr>
                                <td colspan="3"></td>
                                <td class="text-end">
                                    <h5 class="h5-md"><b>Total Keseluruhan :</b></h5>
                                </td>
                                <td>
                                    <h5 id="total-keseluruhan" class="text-center h5-md"><b>Rp 0</b></h5>
                                </td>
                            </tr> --}}

                                        <!-- Hidden input untuk dikirim ke controller -->
                                        <input type="hidden" name="total_harga_barang" id="total_harga_barang">
                                        <input type="hidden" name="ongkir_fix" id="ongkir_fix">

                                        <tr>
                                            <td colspan="3"></td>
                                            <td>
                                                <h5 class="h5-md meat-color text-end">Total Keseluruhan : </h5>
                                            </td>
                                            <td colspan="2" class="product-price-total-keseluruhan">
                                                <h5 id="total-harga" class="text-center h5-md">Rp 0</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-end">
                                                {{-- <button type="submit" class="btn btn-lg btn-meat ">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Kirim Pesanan
                                    </button> --}}
                                                <button type="button" onclick="showQris()" class="btn btn-lg btn-meat">
                                                    {{-- <i class="fa-brands fa-whatsapp"></i> --}}
                                                    Lanjutkan Pembayaran
                                                </button>
                                                <!-- MODAL QRIS -->
                                                <div class="modal fade" id="qrisModal" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content text-center">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Scan & Bayar</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">
                                                                @if (!empty($pengaturan?->gambar))
                                                                    <img src="{{ asset('storage/' . $pengaturan->gambar) }}"
                                                                        alt="QR Pembayaran" class="img-fluid mb-3"
                                                                        style="max-width: 250px;">
                                                                @else
                                                                    <p class="text-muted">QR Pembayaran Belum Tersedia</p>
                                                                @endif

                                                                <h4 id="total-qris" class="mt-3 text-center">
                                                                    Total Pembayaran: Rp 0
                                                                </h4>
                                                                <p class="text-muted">Setelah melakukan pembayaran, klik
                                                                    tombol
                                                                    <b>Selanjutnya</b>.
                                                                </p>
                                                            </div>

                                                            <div class="modal-footer d-flex justify-content-between">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>

                                                                <!-- Tombol Selanjutnya -->
                                                                <button type="button" class="btn btn-meat"
                                                                    onclick="nextToUpload()">
                                                                    Selanjutnya
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- MODAL UPLOAD BUKTI PEMBAYARAN -->
                                                <div class="modal fade" id="uploadModal" tabindex="-1">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            <div class="modal-body">

                                                                <label class="fw-bold">Upload Bukti Transfer</label>
                                                                <input type="file" name="bukti_transfer"
                                                                    class="form-control" accept="image/*" required
                                                                    onchange="previewBukti(event)">

                                                                <small class="text-muted">Format: JPG, PNG. Maks
                                                                    2MB.</small>

                                                                <div class="mt-3 text-center">
                                                                    <img id="previewImage" src="#"
                                                                        alt="Preview Bukti"
                                                                        style="display:none; max-width: 250px; border-radius: 10px;">
                                                                </div>

                                                            </div>

                                                            {{-- ngirim produk ke controller --}}
                                                            <div id="produk-container"></div>

                                                            <div class="modal-footer">
                                                                <button class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>

                                                                <!-- SUBMIT PESANAN -->
                                                                <button type="submit" class="btn btn-meat">
                                                                    Konfirmasi Pesanan
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </form>

    @push('script')
        <script>
            $(document).ready(function() {

                // === Dropdown Kota ===
                $('#province').change(function() {
                    let id = $(this).val();

                    if (id) {
                        $.ajax({
                            url: "/cities/" + id,
                            type: "GET",
                            dataType: "json",
                            success: function(res) {
                                $('#city').empty().append(
                                    '<option value="">-- Pilih Kota --</option>');
                                $.each(res, function(idx, item) {
                                    $('#city').append('<option value="' + item.id + '">' +
                                        item.name + '</option>');
                                });
                            }
                        });
                    }
                });

                // === Dropdown Kecamatan ===
                $('#city').change(function() {
                    let id = $(this).val();

                    if (id) {
                        $.ajax({
                            url: "/districts/" + id,
                            type: "GET",
                            dataType: "json",
                            success: function(res) {
                                $('#district').empty().append(
                                    '<option value="">-- Pilih Kecamatan --</option>');
                                $.each(res, function(idx, item) {
                                    $('#district').append('<option value="' + item.id +
                                        '">' + item.name + '</option>');
                                });
                            }
                        });
                    }
                });

                $(document).ready(function() {
                    localStorage.removeItem("ongkir_fix");

                    function getTotalBeratKoi() {
                        let checkout = JSON.parse(localStorage.getItem("checkout")) || [];
                        let totalQty = 0;

                        checkout.forEach(item => totalQty += item.qty);
                        return totalQty * 400; // gram
                    }

                    // ==== Total Barang dari Keranjang ====
                    function hitungTotalBarang() {
                        let checkout = JSON.parse(localStorage.getItem("checkout")) || [];
                        let total = 0;

                        checkout.forEach(item => {
                            total += item.harga * item.qty;
                        });

                        window.totalBarang = total;
                        return total;
                    }

                    // ==== Update Semua Tampilan =====
                    function updateRincian() {
                        let totalBarang = window.totalBarang || 0;
                        let ongkir = parseInt(localStorage.getItem("ongkir_fix") || 0);
                        let totalFix = totalBarang + ongkir;

                        $("#total-barang").text("Rp " + totalBarang.toLocaleString());
                        $("#total-ongkir").text("Rp " + ongkir.toLocaleString());
                        $("#total-keseluruhan").text("Rp " + totalFix.toLocaleString());
                        $("#total-harga").text("Rp " + totalFix.toLocaleString());

                        $("#total_harga_barang").val(totalBarang);
                        $("#ongkir_fix").val(ongkir);
                    }

                    // ==== AUTO HITUNG ONGKIR ====
                    function autoHitungOngkir() {
                        let district_id = $('#district').val();
                        let courier = $('input[name="courier"]:checked').val();
                        let weight = getTotalBeratKoi();
                        let token = $('meta[name="csrf-token"]').attr('content');

                        if (!district_id || !courier) return;

                        $.ajax({
                            url: "/check-ongkir",
                            type: "POST",
                            data: {
                                _token: token,
                                district_id: district_id,
                                courier: courier,
                                weight: weight
                            },
                            success: function(response) {

                                if (response.length > 0) {
                                    let ongkir = response[0].cost;

                                    localStorage.setItem("ongkir_fix", ongkir);
                                }

                                updateRincian();
                            },
                            error: function() {
                                alert("Gagal menghitung ongkir otomatis.");
                            }
                        });
                    }

                    // ==== TRIGGER USER ====
                    $('#district').change(function() {
                        autoHitungOngkir();
                    });

                    $('input[name="courier"]').change(function() {
                        autoHitungOngkir();
                    });

                    $('#province, #city').change(function() {
                        localStorage.removeItem("ongkir_fix");
                        updateRincian();
                    });

                    // ==== LOAD AWAL ====
                    hitungTotalBarang();
                    updateRincian();
                });


                // Ketika ongkir ditemukan otomatis
                function setOngkir(value) {
                    window.ongkirFix = value;
                    updateRincianHarga();
                }

                // Ketika total barang sudah dihitung dari keranjang
                function setTotalBarang(value) {
                    window.totalHargaBarang = value;
                    updateRincianHarga();
                }

            });
        </script>
        <script>
            function previewBukti(event) {
                const img = document.getElementById('previewImage');
                img.src = URL.createObjectURL(event.target.files[0]);
                img.style.display = 'block';
            }
        </script>

        <script>
            window.showQris = function() {

                let totalBarang = window.totalBarang || 0;
                let ongkir = parseInt(localStorage.getItem("ongkir_fix") || 0);
                let totalFix = totalBarang + ongkir;

                // UPDATE LANGSUNG TANPA APPEND
                document.getElementById("total-qris").innerHTML =
                    `Total Pembayaran: <b>Rp ${new Intl.NumberFormat('id-ID').format(totalFix)}</b>`;

                // Tampilkan modal QRIS
                var qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
                qrisModal.show();
            };

            function nextToUpload() {
                // Tutup QRIS
                var qrisModal = bootstrap.Modal.getInstance(document.getElementById('qrisModal'));
                qrisModal.hide();

                // Buka modal upload bukti bayar
                var uploadModal = new bootstrap.Modal(document.getElementById('uploadModal'));
                uploadModal.show();
            }

            function previewBukti(event) {
                const img = document.getElementById('previewImage');
                img.src = URL.createObjectURL(event.target.files[0]);
                img.style.display = 'block';
            }
        </script>



        <script>
            document.addEventListener("DOMContentLoaded", () => {
                // Ambil data user sebelumnya
                const savedData = JSON.parse(localStorage.getItem("userCheckoutForm")) || {};

                // isi otomatis jika ada data
                if (savedData.nama) document.querySelector('input[name="nama_pembeli"]').value = savedData.nama;
                if (savedData.telepon) document.querySelector('input[name="telepon"]').value = savedData.telepon;
                if (savedData.alamat) document.querySelector('textarea[name="alamat"]').value = savedData.alamat;

                // Simpan otomatis setiap user mengetik
                const inputs = document.querySelectorAll(
                    'input[name="nama_pembeli"], input[name="telepon"], textarea[name="alamat"]');
                inputs.forEach(input => {
                    input.addEventListener("input", function() {
                        let newData = {
                            nama: document.querySelector('input[name="nama_pembeli"]').value,
                            telepon: document.querySelector('input[name="telepon"]').value,
                            alamat: document.querySelector('textarea[name="alamat"]').value
                        };
                        localStorage.setItem("userCheckoutForm", JSON.stringify(newData));
                    });
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let checkout = JSON.parse(localStorage.getItem("checkout")) || [];
                const tbody = document.querySelector("#myTable tbody");
                const totalKeseluruhanEl = document.querySelector("#total-harga");

                function renderTable() {
                    tbody.innerHTML = "";
                    let totalKeseluruhan = 0;

                    if (checkout.length === 0) {
                        tbody.innerHTML = "<tr><td colspan='6' class='text-center'>Tidak ada produk dipilih</td></tr>";
                    } else {
                        checkout.forEach((item, index) => {
                            let total = item.harga * item.qty;
                            if (item.dipilih) {
                                totalKeseluruhan += total;
                            }

                            tbody.innerHTML += `
                                <tr>
                                    <td class="product-name">
                                        <div class="cart-product-desc d-flex align-items-center">
                                            <img src="${item.gambar}" width="60" style="margin-right:10px; border-radius:6px;">
                                            <div>
                                                <h5 class="mb-1 fw-bold h5-sm">${item.nama}</h5>
                                                <p class="p-sm text-muted">Kode: ${item.id}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><h5>Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</h5></td>
                                    <td><h5 class="badge bg-light text-dark">${item.qty} x</h5></td>
                                    <td class="text-center"><h5>Rp ${new Intl.NumberFormat('id-ID').format(total)}</h5></td>
                                </tr>
                            `;
                        });
                    }

                    totalKeseluruhanEl.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(totalKeseluruhan);

                    document.querySelectorAll(".hapus-btn").forEach(btn => {
                        btn.addEventListener("click", e => {
                            let idx = e.currentTarget.getAttribute("data-index");
                            checkout.splice(idx, 1);
                            localStorage.setItem("checkout", JSON.stringify(checkout));
                            renderTable();
                        });
                    });

                    document.querySelectorAll(".pilih-checkbox").forEach(checkbox => {
                        checkbox.addEventListener("change", e => {
                            let idx = e.currentTarget.getAttribute("data-index");
                            checkout[idx].dipilih = e.currentTarget.checked;
                            localStorage.setItem("checkout", JSON.stringify(checkout));
                            renderTable();
                        });
                    });
                }

                renderTable();
            });

            document.addEventListener("DOMContentLoaded", () => {
                const form = document.querySelector("form");
                form.addEventListener("submit", function(e) {
                    let checkout = JSON.parse(localStorage.getItem("checkout")) || [];
                    let dipilih = checkout.filter(item => item.dipilih);

                    // hapus hidden lama
                    document.querySelectorAll(".produk-hidden").forEach(el => el.remove());

                    dipilih.forEach((item, i) => {
                        let inputId = document.createElement("input");
                        inputId.type = "hidden";
                        inputId.name = `produk[${i}][id]`;
                        inputId.value = item.id;
                        inputId.classList.add("produk-hidden");
                        form.appendChild(inputId);

                        let inputQty = document.createElement("input");
                        inputQty.type = "hidden";
                        inputQty.name = `produk[${i}][qty]`;
                        inputQty.value = item.qty;
                        inputQty.classList.add("produk-hidden");
                        form.appendChild(inputQty);

                        let inputHarga = document.createElement("input");
                        inputHarga.type = "hidden";
                        inputHarga.name = `produk[${i}][harga]`;
                        inputHarga.value = item.harga;
                        inputHarga.classList.add("produk-hidden");
                        form.appendChild(inputHarga);

                        let inputNama = document.createElement("input");
                        inputNama.type = "hidden";
                        inputNama.name = `produk[${i}][nama]`;
                        inputNama.value = item.nama;
                        inputNama.classList.add("produk-hidden");
                        form.appendChild(inputNama);
                    });
                });
            });
        </script>

        {{-- buat ngirim produk --}}
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let checkout = JSON.parse(localStorage.getItem("checkout")) || [];
                const container = document.getElementById("produk-container");

                // bersihin dulu
                container.innerHTML = "";

                // generate hidden input ke dalam form
                checkout.forEach(item => {
                    container.innerHTML += `
            <input type="hidden" name="produk[${item.id}][id]" value="${item.id}">
            <input type="hidden" name="produk[${item.id}][nama]" value="${item.nama}">
            <input type="hidden" name="produk[${item.id}][qty]" value="${item.qty}">
            <input type="hidden" name="produk[${item.id}][harga]" value="${item.harga}">
        `;
                });
            });
        </script>
    @endpush
@endsection
