@extends('main')
@section('content')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Rekap</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Azza Koi Farm
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Rekap</h5>
            <div class="input-group" style="width: 220px;">
                <label for="tanggal" class="col-form-label me-2">Filter</label>
                <input type="date" id="tanggal" name="tanggal" value="" class="form-control form-control-sm">
                {{-- <input type="month" id="tanggal" name="tanggal" value="" class="form-control form-control-sm"> --}}
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="rekapTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pengeluaran</th>
                        </tr>
                    </thead>
                    <tbody id="rekapBody">
                        @foreach ($rekap as [$a, $b])
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $a->tanggal }}</td>
                                <td>Rp{{ number_format(optional($a)->total, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format(optional($b)->nominal ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                var table = $('#example2').DataTable({
                    lengthChange: false,
                    buttons: ['copy', 'excel', 'pdf', 'print']
                });

                table.buttons().container()
                    .appendTo('#example2_wrapper .col-md-6:eq(0)');
            });

            document.addEventListener("DOMContentLoaded", function() {
                const filterInput = document.getElementById("tanggal");
                const tableBody = document.getElementById("rekapBody");

                function filterTable() {
                    const selectedDate = filterInput.value;
                    const rows = tableBody.querySelectorAll("tr");

                    let visibleCount = 0;

                    const emptyRow = document.getElementById("noDataRow");
                    if (emptyRow) emptyRow.remove();

                    rows.forEach(row => {
                        const tanggalCell = row.querySelector("td:nth-child(2)");
                        const tanggal = tanggalCell.textContent.trim();

                        if (selectedDate === "" || tanggal === selectedDate) {
                            row.style.display = "";
                            visibleCount++;
                        } else {
                            row.style.display = "none";
                        }
                    });

                    if (visibleCount === 0) {
                        const tr = document.createElement("tr");
                        tr.id = "noDataRow";
                        tr.innerHTML = `
                            <td colspan="4" class="text-center text-muted">
                                Data tidak tersedia pada rentang ini
                            </td>
                        `;
                        tableBody.appendChild(tr);
                    }
                }

                filterTable();

                filterInput.addEventListener("change", filterTable);
            });

            //ini kalo typenya month
            // document.addEventListener("DOMContentLoaded", function() {
            //     const filterInput = document.getElementById("tanggal");
            //     const tableBody = document.getElementById("rekapBody");

            //     function filterTable() {
            //         const selectedMonth = filterInput.value;
            //         const rows = tableBody.querySelectorAll("tr");

            //         let visibleCount = 0;

            //         rows.forEach(row => {
            //             const tanggalCell = row.querySelector("td:nth-child(2)");
            //             const tanggal = tanggalCell.textContent.trim().substring(0, 7);

            //             if (selectedMonth === "" || tanggal === selectedMonth) {
            //                 row.style.display = "";
            //                 visibleCount++;
            //             } else {
            //                 row.style.display = "none";
            //             }
            //         });

            //         const emptyRow = document.getElementById("noDataRow");
            //         if (emptyRow) emptyRow.remove();

            //         if (visibleCount === 0) {
            //             const tr = document.createElement("tr");
            //             tr.id = "noDataRow";
            //             tr.innerHTML = `
    //     <td colspan="4" class="text-center text-muted">
    //         Data tidak tersedia pada bulan ini
    //     </td>
    // `;
            //             tableBody.appendChild(tr);
            //         }
            //     }

            //     filterTable();

            //     filterInput.addEventListener("change", filterTable);
            // });
        </script>
    @endpush
@endsection
