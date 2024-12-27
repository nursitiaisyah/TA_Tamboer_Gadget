<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan</title>
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
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Laporan Pemasukan</h5>
                            <button type="button" class="btn btn-secondary btn-margin" onclick="window.history.back()">
                                <i class="fas fa-arrow-left"></i>
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
                            </form>
                            <div class="table-responsive mt-3">
                                <table id="example" class="table table-striped custom-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>

                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Sumber</th>
                                            <th scope="col">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $tanggal_dari = isset($_POST['tanggal_dari']) ? $_POST['tanggal_dari'] : '';
                                        $tanggal_hingga = isset($_POST['tanggal_hingga']) ? $_POST['tanggal_hingga'] : '';

                                        if (!empty($tanggal_dari) && !empty($tanggal_hingga)) {
                                            $sql = "SELECT * FROM pemasukan WHERE tanggal BETWEEN '$tanggal_dari' AND '$tanggal_hingga'";
                                        } else {
                                            $sql = "SELECT * FROM pemasukan";
                                        }

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                    <th scope='row'>" . $no++ . "</th>
                                                    
                                                    <td>" . $row['tanggal'] . "</td>
                                                    <td>" . $row['keterangan'] . "</td>
                                                    <td>" . $row['sumber_dana'] . "</td>
                                                    <td>" . number_format($row['jumlah'], 0) . "</td>
                                                </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='6' class='text-center'>No data available</td></tr>";
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

        document.getElementById('exportExcel').addEventListener('click', function () {
            var table = $('#example').DataTable();
            var data = table.rows({ search: 'applied' }).data().toArray();
            var worksheetData = [['No', 'Kode', 'Tanggal', 'Keterangan', 'Sumber', 'Jumlah']];
            data.forEach(function (row, index) {
                worksheetData.push([index + 1, row[1], row[2], row[3], row[4], row[5]]);
            });
            var worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
            var workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Laporan');
            XLSX.writeFile(workbook, 'Laporan_Pemasukan.xlsx');
        });

        document.getElementById('exportPDF').addEventListener('click', function () {
            var { jsPDF } = window.jspdf;
            var doc = new jsPDF();
            var pageWidth = doc.internal.pageSize.getWidth();
            var title = "LAPORAN PEMASUKAN";
            var textWidth = doc.getTextWidth(title);
            var x = (pageWidth - textWidth) / 2;
            doc.text(title, x, 20);
            doc.autoTable({
                html: '#example',
                startY: 30,
                headStyles: { fillColor: [0, 0, 0] },
                styles: { halign: 'center' }
            });
            doc.save('Laporan_Pemasukan.pdf');
        });
    </script>
</body>

</html>