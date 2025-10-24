@extends('main')
@section('content')
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
                        <h2 class="h2-xl">Keranjang</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="cart-1" class="wide-100 cart-page division">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="cart-table mb-70">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">Pilih</th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col" class="text-center">Total</th>
                                    <th scope="col" class="text-end">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Isi keranjang akan diisi lewat JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Total Keseluruhan -->
            <table>
                <thead>
                    <tr>
                        <td colspan="3"></td>
                        <td>
                            <h5 class="h5-md meat-color text-end">
                                Total Keseluruhan :
                            </h5>
                        </td>
                        <td colspan="2" class="product-price-total-keseluruhan">
                            <h5 class="text-center h5-md">Rp 0</h5>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-end">
                            <a href="{{ route('format') }}" class="btn btn-lg btn-meat ">
                                Lanjutkan Pemesanan
                            </a>
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </section>

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", async () => {
                async function fetchLatestProducts() {
                    try {
                        const response = await fetch("http://127.0.0.1:8000/api/products");
                        const data = await response.json();
                        return data.data || data;
                    } catch (error) {
                        console.error("Gagal ambil data produk:", error);
                        return [];
                    }
                }

                async function syncCartWithDatabase() {
                    let cart = JSON.parse(localStorage.getItem("cart")) || [];
                    const latestProducts = await fetchLatestProducts();

                    cart = cart.map(item => {
                        const found = latestProducts.find(p => p.kode_produk === item.id);
                        if (found) {
                            item.stok = found.stok_produk;
                            item.harga = found.harga_Satuan;
                        }
                        if (item.dipilih === undefined) item.dipilih = false; // ⬅️ default false
                        return item;
                    });

                    localStorage.setItem("cart", JSON.stringify(cart));
                    return cart;
                }

                let cart = await syncCartWithDatabase();
                const tbody = document.querySelector("#myTable tbody");
                const totalKeseluruhanEl = document.querySelector(".product-price-total-keseluruhan h5");

                tbody.innerHTML = "";
                if (cart.length === 0) {
                    tbody.innerHTML = "<tr><td colspan='6' class='text-center'>Keranjang kosong</td></tr>";
                } else {
                    cart.forEach((item, index) => {
                        let total = item.harga * item.qty;
                        let stokKosong = item.stok === 0;

                        tbody.innerHTML += `
                        <tr class="${stokKosong ? 'opacity-50' : ''}">
                            <td data-label="Pilih" class="text-center">
                                <input
                                    type="checkbox"
                                    class="pilih-checkbox"
                                    data-index="${index}"
                                    ${stokKosong ? "disabled" : (item.dipilih ? "checked" : "")}
                                >
                            </td>
                            <td data-label="Produk" class="product-name">
                                <div class="cart-product-desc d-flex align-items-center">
                                    <img src="${item.gambar}" width="60" style="margin-right:10px; border-radius:6px;">
                                    <div>
                                        <h5 class="mb-1 h5-sm">${item.nama}</h5>
                                        <p class="p-sm text-muted">Kode: ${item.id}</p>
                                    </div>
                                </div>
                            </td>
                            <td data-label="Harga" class="product-price">
                                <h5 class="h5-md">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</h5>
                            </td>
                            <td data-label="Item" class="product-qty">
                                <input
                                    class="qty-input"
                                    type="number"
                                    min="1"
                                    max="${item.stok}"
                                    value="${item.qty}"
                                    data-index="${index}"
                                    ${stokKosong ? "disabled" : ""}
                                >
                            </td>
                            <td data-label="Stok" class="product-qty">
                                ${stokKosong
                                ? '<span class="badge bg-danger">Stok Habis</span>'
                                : '<h5 class="h5-md">' + (item.stok ?? '-') + '</h5>'}
                            </td>
                            <td data-label="Total" class="product-price-total text-end">
                                <h5 class="h5-md">Rp ${new Intl.NumberFormat('id-ID').format(total)}</h5>
                            </td>
                            <td data-label="Hapus" class="td-trash text-end">
                                <button class="hapus-btn btn btn-sm btn-outline-danger" data-index="${index}">
                                    <i class="far fa-trash-alt" style="color: red;"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    });
                }

                // ✅ hitung total hanya produk yang dicentang
                function hitungTotal() {
                    let totalKeseluruhan = 0;
                    cart.forEach(item => {
                        if (item.dipilih && item.stok > 0) {
                            totalKeseluruhan += item.harga * item.qty;
                        }
                    });
                    totalKeseluruhanEl.textContent =
                        "Rp " + new Intl.NumberFormat('id-ID').format(totalKeseluruhan);
                }

                hitungTotal(); // langsung panggil biar sync di awal

                // checkbox listener
                document.querySelectorAll(".pilih-checkbox").forEach(checkbox => {
                    checkbox.addEventListener("change", () => {
                        let index = checkbox.dataset.index;
                        cart[index].dipilih = checkbox.checked;
                        localStorage.setItem("cart", JSON.stringify(cart));
                        hitungTotal();
                    });
                });

                // hapus produk
                document.querySelectorAll(".hapus-btn").forEach(btn => {
                    btn.addEventListener("click", () => {
                        let index = btn.dataset.index;
                        cart.splice(index, 1);
                        localStorage.setItem("cart", JSON.stringify(cart));
                        location.reload();
                    });
                });

                // ubah qty
                document.querySelectorAll(".qty-input").forEach(input => {
                    input.addEventListener("change", () => {
                        let index = input.dataset.index;
                        cart[index].qty = parseInt(input.value);
                        const totalCell = input.closest("tr").querySelector(
                            ".product-price-total h5");
                        totalCell.textContent =
                            "Rp " + new Intl.NumberFormat("id-ID").format(cart[index].harga * cart[
                                index].qty);
                        localStorage.setItem("cart", JSON.stringify(cart));
                        hitungTotal();
                    });
                });

                // ✅ Lanjutkan hanya kirim item yang dipilih dan stoknya masih ada
                const lanjutkanBtn = document.querySelector("a.btn-meat");
                lanjutkanBtn.addEventListener("click", (e) => {
                    e.preventDefault();

                    // ambil ulang dari localStorage biar paling update
                    let cart = JSON.parse(localStorage.getItem("cart")) || [];

                    // cuma item yang dipilih (checked) & stoknya masih > 0
                    let terpilih = cart.filter(item => item.dipilih && item.stok > 0);

                    if (terpilih.length === 0) {
                        alert("Pilih minimal satu produk sebelum melanjutkan ya 🥺");
                        return;
                    }

                    // simpan ke localStorage checkout
                    localStorage.setItem("checkout", JSON.stringify(terpilih));

                    // pindah halaman ke format/index
                    window.location.href = lanjutkanBtn.getAttribute("href");
                });
            });
        </script>
    @endpush
@endsection
