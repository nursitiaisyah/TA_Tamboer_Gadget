<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- jsPDF and autoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.18/jspdf.plugin.autotable.min.js"></script>
    <!-- SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        /* Custom styles for responsive tables */
        @media (max-width: 768px) {
            table.dataTable tbody td {
                font-size: 11px;
            }
        }

        @media (min-width: 769px) {
            table.dataTable tbody td {
                font-size: 14px;
            }
        }

        .form-label {
            min-width: 70px;
        }

        /* Adjust the width of the month select box */
        #month {
            max-width: 120px;
            font-size: 14px;
            /* Set font size for month dropdown */
        }

        #year {
            max-width: 80px;
        }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main">
            <!-- Navbar -->
            <?php include 'navbar.php'; ?>

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Laporan Keuangan</h5>
                            <!-- <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i>
                            </button> -->

                            <button type="button" class="btn btn-secondary"
                                style="font-size: 14px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px;"
                                onclick="window.history.back()">
                                <i class="fas fa-arrow-left" style="font-size: 14px;"></i> Kembali
                            </button>
                        </div>

                        <div class="card-body">
                            <form action="laporan_keuangan.php" method="get">
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="month" class="form-label">Bulan:</label>
                                        <select id="month" name="month" class="form-select">
                                            <option value="0">Pilih Bulan</option>
                                            <option value="01">Januari</option>
                                            <option value="02">Februari</option>
                                            <option value="03">Maret</option>
                                            <option value="04">April</option>
                                            <option value="05">Mei</option>
                                            <option value="06">Juni</option>
                                            <option value="07">Juli</option>
                                            <option value="08">Agustus</option>
                                            <option value="09">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="year" class="form-label">Tahun:</label>
                                        <input type="number" id="year" name="year" class="form-control form-control-sm"
                                            min="2020" max="2099" step="1" value="<?php echo date('Y'); ?>">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="font-size: 14px;"><i
                                                class="fas fa-filter"></i> Filter</button>
                                    </div>
                                    <div>
                                        <!-- Tombol Export Excel dengan ikon -->
                                        <button type="button" class="btn btn-success" id="exportExcel"
                                            style="font-size: 14px;">
                                            <i class="fas fa-file-excel"></i> Excel
                                        </button>
                                        <!-- Tombol Export PDF dengan ikon -->
                                        <button type="button" class="btn btn-danger" id="exportPDF"
                                            style="font-size: 14px;">
                                            <i class="fas fa-file-pdf"></i> PDF
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mt-3">
                                <table id="example" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Bulan</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Total Pemasukan</th>
                                            <th scope="col">Total Pengeluaran</th>
                                            <th scope="col">Total Penjualan</th>
                                            <th scope="col">Keuntungan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $month = isset($_GET['month']) ? $_GET['month'] : date('m');
                                        $year = isset($_GET['year']) ? $_GET['year'] : date('Y');

                                        $month_name = date('F', mktime(0, 0, 0, $month, 10));

                                        $sql_pemasukan = "SELECT SUM(jumlah) AS total_pemasukan FROM pemasukan WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year'";
                                        $result_pemasukan = $conn->query($sql_pemasukan);
                                        $total_pemasukan = $result_pemasukan->fetch_assoc()['total_pemasukan'] ?? 0;

                                        $sql_pengeluaran = "SELECT SUM(total_harga) AS total_pengeluaran FROM pengeluaran WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year'";
                                        $result_pengeluaran = $conn->query($sql_pengeluaran);
                                        $total_pengeluaran = $result_pengeluaran->fetch_assoc()['total_pengeluaran'] ?? 0;

                                        $sql_penjualan = "SELECT SUM(total_harga) AS total_penjualan FROM penjualan WHERE MONTH(tanggal) = '$month' AND YEAR(tanggal) = '$year'";
                                        $result_penjualan = $conn->query($sql_penjualan);
                                        $total_penjualan = $result_penjualan->fetch_assoc()['total_penjualan'] ?? 0;

                                        $keuntungan = $total_penjualan - $total_pengeluaran;

                                        echo "<tr>
                                    <td>1</td>
                                    <td>$month_name</td>
                                    <td>$year</td>
                                    <td>" . number_format($total_pemasukan, 0, ',', '.') . "</td>
                                    <td>" . number_format($total_pengeluaran, 0, ',', '.') . "</td>
                                    <td>" . number_format($total_penjualan, 0, ',', '.') . "</td>
                                    <td>" . number_format($keuntungan, 0, ',', '.') . "</td>
                                </tr>";
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom JS -->
    <script src="../js/script.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": []
            });
        });

        document.getElementById('exportExcel').addEventListener('click', function () {
            var table = $('#example').DataTable();
            var data = table.rows({ search: 'applied' }).data().toArray();

            // Tambahkan baris untuk judul laporan
            var worksheetData = [["LAPORAN KEUANGAN TAMBOER GADGET"], []]; // Judul di baris pertama
            worksheetData.push(["No", "Bulan", "Tahun", "Total Pemasukan", "Total Pengeluaran", "Total Penjualan", "Keuntungan"]);

            // Isi data tabel
            data.forEach(function (row, index) {
                worksheetData.push([index + 1, row[1], row[2], row[3], row[4], row[5], row[4]]);
            });

            // Buat worksheet dan workbook
            var worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Laporan');

            // Simpan file Excel
            XLSX.writeFile(workbook, 'Laporan_Keuangan.xlsx');
        });



        document.getElementById('exportPDF').addEventListener('click', function () {
            var { jsPDF } = window.jspdf;
            var doc = new jsPDF();
            var pageWidth = doc.internal.pageSize.getWidth();
            var title = "LAPORAN KEUANGAN TAMBOER GADGET";
            var textWidth = doc.getTextWidth(title);
            var x = (pageWidth - textWidth) / 2;
            doc.text(title, x, 20);
            doc.autoTable({
                html: '#example',
                startY: 30,
                headStyles: { fillColor: [0, 0, 0] },
                styles: { halign: 'center' }
            });
            doc.save('Laporan_Keuangan.pdf');
        });
    </script>
</body>

</html>