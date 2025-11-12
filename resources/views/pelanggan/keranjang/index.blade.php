@extends('pelanggan.mainPelanggan')
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
                        {{-- <h2 class="h2-xl">Keranjang</h2> --}}
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
                            <p class="h5-md fw-bold meat-color text-end">
                                Total Keseluruhan :
                            </p>
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
                        if (item.dipilih === undefined) item.dipilih = false;
                        return item;
                    });

                    localStorage.setItem("cart", JSON.stringify(cart));
                    return cart;
                }

                let cart = await syncCartWithDatabase();
                const tbody = document.querySelector("#myTable tbody");
                const totalKeseluruhanEl = document.querySelector(".product-price-total-keseluruhan h5");

                function renderCart() {
                    tbody.innerHTML = "";
                    if (cart.length === 0) {
                        tbody.innerHTML = "<tr><td colspan='6' class='text-center'>Keranjang kosong</td></tr>";
                    } else {
                        cart.forEach((item, index) => {
                            const total = item.harga * item.qty;
                            const stokKosong = item.stok === 0;

                            tbody.innerHTML += `
                <tr class="${stokKosong ? 'opacity-50' : ''}">
                    <td data-label="Pilih" class="text-center fs-5">
                        <input type="checkbox" class="pilih-checkbox fs-5"
                            data-index="${index}"
                            ${stokKosong ? "disabled" : (item.dipilih ? "checked" : "")}>
                    </td>
                    <td data-label="Produk" class="product-name">
                        <div class="cart-product-desc d-flex align-items-center">
                            <img src="${item.gambar}" width="60" style="margin-right:10px; border-radius:6px;">
                            <div>
                                <p class="mb-1 fw-bold h5-sm">${item.nama}</p>
                                <p class="p-sm text-muted">Kode: ${item.id}</p>
                            </div>
                        </div>
                    </td>
                    <td data-label="Harga" class="product-price">
                        <p class="h5-md fw-bold">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</p>
                    </td>
                    <td data-label="Item" class="product-qty">
                        <input class="qty-input" type="number" min="1" max="${item.stok}"
                               value="${item.qty}" data-index="${index}"
                               ${stokKosong ? "disabled" : ""}>
                    </td>
                    <td data-label="Stok" class="product-qty">
                        ${stokKosong
                            ? '<span class="badge bg-danger">Stok Kosong</span>'
                            : '<p class="h5-md fw-bold">' + (item.stok ?? '-') + '</p>'}
                    </td>
                    <td data-label="Total" class="product-price-total text-end">
                        <p class="h5-md fw-bold subtotal">Rp ${new Intl.NumberFormat('id-ID').format(total)}</p>
                    </td>
                    <td data-label="Hapus" class="td-trash text-end">
                        <button class="hapus-btn btn btn-sm btn-outline-danger" data-index="${index}">
                            <i class="far fa-trash-alt" style="color: red;"></i>
                        </button>
                    </td>
                </tr>`;
                        });
                    }
                    attachListeners();
                    hitungTotal();
                }

                function hitungTotal() {
                    let totalKeseluruhan = 0;
                    cart.forEach(item => {
                        if (item.dipilih && item.stok > 0) {
                            totalKeseluruhan += item.harga * item.qty;
                        }
                    });
                    totalKeseluruhanEl.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(
                    totalKeseluruhan);
                }

                function attachListeners() {
                    document.querySelectorAll(".pilih-checkbox").forEach(checkbox => {
                        checkbox.addEventListener("change", () => {
                            const index = checkbox.dataset.index;
                            cart[index].dipilih = checkbox.checked;
                            localStorage.setItem("cart", JSON.stringify(cart));
                            hitungTotal();
                        });
                    });

                    document.querySelectorAll(".hapus-btn").forEach(btn => {
                        btn.addEventListener("click", () => {
                            const index = btn.dataset.index;
                            cart.splice(index, 1);
                            localStorage.setItem("cart", JSON.stringify(cart));
                            renderCart();
                        });
                    });

                    document.querySelectorAll(".qty-input").forEach(input => {
                        input.addEventListener("input", () => {
                            const index = input.dataset.index;
                            let newQty = parseInt(input.value);
                            if (isNaN(newQty) || newQty < 1) newQty = 1;
                            if (newQty > cart[index].stok) newQty = cart[index].stok;
                            cart[index].qty = newQty;

                            // update subtotal row ini langsung
                            const subtotalEl = input.closest("tr").querySelector(".subtotal");
                            subtotalEl.textContent = "Rp " + new Intl.NumberFormat('id-ID').format(
                                cart[index].harga * newQty);

                            // simpan ke localStorage & update total keseluruhan
                            localStorage.setItem("cart", JSON.stringify(cart));
                            hitungTotal();
                        });
                    });
                }

                renderCart();

                const lanjutkanBtn = document.querySelector("a.btn-meat");
                lanjutkanBtn.addEventListener("click", (e) => {
                    e.preventDefault();

                    const terpilih = cart.filter(item => item.dipilih && item.stok > 0);
                    if (terpilih.length === 0) {
                        alert("Pilih minimal satu produk sebelum melanjutkan ya 🥺");
                        return;
                    }

                    localStorage.setItem("checkout", JSON.stringify(terpilih));
                    window.location.href = lanjutkanBtn.getAttribute("href");
                });
            });
        </script>
    @endpush
@endsection
