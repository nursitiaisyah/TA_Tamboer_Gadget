<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran</title>
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

            table.dataTable thead th {
                font-size: 11px;
            }
        }

        @media (min-width: 769px) {
            table.dataTable tbody td {
                font-size: 14px;
            }

            table.dataTable thead th {
                font-size: 14px;
            }
        }

        .form-label {
            min-width: 70px;
        }

        .form-control-sm {
            max-width: 200px;
        }

        .form-control-date {
            max-width: 119px;
        }

        .btn-margin-group {
            margin: 10px 0;
        }

        /* Custom table border styles */
        .custom-table th,
        .custom-table td {
            border-bottom: 1px solid #dee2e6;
        }

        .custom-table thead th {
            border-top: 1px solid #dee2e6;
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

            <!-- Main Content Area -->
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                        </div>
                    </div>

                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Laporan Penjualan</h5>
                            <button type="button" class="btn btn-secondary"
                                style="font-size: 14px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px;"
                                onclick="window.history.back()">
                                <i class="fas fa-arrow-left" style="font-size: 14px;"></i> Kembali
                            </button>

                        </div>

                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="tanggal_dari" class="form-label">Dari</label>
                                        <input type="date" class="form-control form-control-sm form-control-date"
                                            id="tanggal_dari" name="tanggal_dari" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <label for="tanggal_hingga" class="form-label">Hingga</label>
                                        <input type="date" class="form-control form-control-sm form-control-date"
                                            id="tanggal_hingga" name="tanggal_hingga" required>
                                    </div>
                                </div>
                                <!-- Akhir Tanggal Dari dan Hingga -->

                                <!-- Tombol Filter dan Refresh -->
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
                                            <th scope="col">Nomor Faktur</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Kasir</th>
                                            <th scope="col">Pembeli</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Varian</th>
                                            <th scope="col">Harga Jual</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $tanggal_dari = isset($_POST['tanggal_dari']) ? $_POST['tanggal_dari'] : '';
                                        $tanggal_hingga = isset($_POST['tanggal_hingga']) ? $_POST['tanggal_hingga'] : '';

                                        $sql = "SELECT 
    f.kode_penjualan, 
    p.tanggal, 
    u.nama AS kasir, 
    p.nama_pembeli, 
    p.no_hp, 
    CONCAT(prod.nama_hp, ' / ', v.ram, ' / ', v.penyimpanan, ' / ', v.warna) AS varian, 
    p.harga_jual, 
    p.jumlah, 
    p.total_harga, 
    p.metode_pembayaran 
FROM penjualan p
JOIN varian v ON p.id_varian = v.id_varian
JOIN produk prod ON v.id_produk = prod.id_produk
JOIN users u ON p.id_user = u.id_user
JOIN faktur_penjualan f ON p.id_faktur = f.id_faktur
ORDER BY p.tanggal DESC, p.id_penjualan DESC";

                                        if (!empty($tanggal_dari) && !empty($tanggal_hingga)) {
                                            $sql .= " WHERE p.tanggal BETWEEN '$tanggal_dari' AND '$tanggal_hingga'";
                                        }

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
            <th scope='row'>" . $no++ . "</th>
            <td>" . $row['kode_penjualan'] . "</td>  <!-- Menampilkan Kode Jual -->
            <td>" . date('d-m-Y', strtotime($row['tanggal'])) . "</td>
            <td>" . $row['kasir'] . "</td>  <!-- Menampilkan Kasir -->
            <td>" . $row['nama_pembeli'] . "</td>  <!-- Menampilkan Pembeli -->
            <td>" . $row['no_hp'] . "</td>  <!-- Menampilkan No HP -->
            <td>" . $row['varian'] . "</td>
            <td>" . number_format($row['harga_jual'], 0, ',', '.') . "</td>
            <td>" . $row['jumlah'] . "</td>
            <td>" . number_format($row['total_harga'], 0, ',', '.') . "</td>
            <td>" . $row['metode_pembayaran'] . "</td>
        </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='11' class='text-center'>No data available</td></tr>"; // Update colspan sesuai jumlah kolom
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

        function resetForm() {
            // Reset semua input dalam form dengan ID tertentu
            document.getElementById("filterForm").reset();
            // Reload halaman setelah mereset form untuk mengembalikan data ke setelan semula
            location.reload();
        }

        document.getElementById('exportExcel').addEventListener('click', function () {
            var table = $('#example').DataTable();
            var data = table.rows({ search: 'applied' }).data().toArray();

            // Menambahkan judul pada worksheet
            var worksheetData = [['LAPORAN PENJUALAN TAMBOER GADGET']];  // Judul laporan
            worksheetData.push([]); // Menambahkan baris kosong setelah judul

            // Menambahkan header tabel
            worksheetData.push(['No', 'Tanggal', 'Varian', 'Pengguna', 'Harga Jual', 'Jumlah', 'Total', 'Pembayaran']);

            // Menambahkan data dari tabel
            data.forEach(function (row, index) {
                worksheetData.push([index + 1, row[1], row[2], row[3], row[4], row[5], row[6], row[7]]);
            });

            // Membuat worksheet dan workbook
            var worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Laporan Penjualan');

            // Menyimpan file Excel
            XLSX.writeFile(workbook, 'Laporan_Penjualan.xlsx');
        });



        document.getElementById('exportPDF').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            var doc = new jsPDF('landscape'); // Set orientasi halaman menjadi landscape

            // Tambahkan judul di bagian atas halaman
            var pageWidth = doc.internal.pageSize.getWidth();
            var title = "LAPORAN PENJUALAN TAMBOER GADGET";
            var textWidth = doc.getTextWidth(title);
            var x = (pageWidth - textWidth) / 2; // Posisi tengah
            doc.text(title, x, 20);

            // Tambahkan tabel
            doc.autoTable({
                html: '#example',
                startY: 30, // Mulai setelah judul
                headStyles: { fillColor: [0, 0, 0] },
                styles: { halign: 'center' }
            });

            // Simpan file PDF
            doc.save('Laporan_Penjualan.pdf');
        });


    </script>
</body>

</html>