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

    <form action="{{ route('pesanan.kirim') }}" method="POST" class="row">
        @csrf
        <section class="wide-100 cart-page division">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="mt-5 card  text-light" style="background-color: #be170b">
                            <div class="card-body">
                                <p>
                                    <i class="bi bi-info-circle-fill"></i>
                                    Semua pesanan akan diproses berdasarkan urutan antrian. Kami berkomitmen memproses dan
                                    mengirimkan pesanan secepat mungkin sesuai jadwal yang telah ditetapkan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
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
                                                    <span class="input-group-text" id="basic-addon1">62</span>
                                                    <input type="" class="form-control" placeholder="Username"
                                                        name="telepon" aria-label="Masukkan Nomor Telepon"
                                                        aria-describedby="basic-addon1" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2 col-md-12 col-lg-12">
                                            <label for="">Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control " placeholder="Masukkan Alamat Lengkap" required></textarea>
                                        </div>

                                        <div class="text-center col-md-12">
                                            <div class="sending-msg"><span class="loading"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                                <td>
                                    <h5 class="h5-md meat-color text-end">Total Keseluruhan : </h5>
                                </td>
                                <td colspan="2" class="product-price-total-keseluruhan">
                                    <h5 id="total-harga" class="text-center h5-md">Rp 0</h5>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-end">
                                    <button type="submit" class="btn btn-lg btn-meat ">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        Kirim Pesanan
                                    </button>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </section>
        </section>
    </form>

    @push('script')
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
    @endpush
@endsection
