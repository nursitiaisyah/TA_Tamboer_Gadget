<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
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

        .btn-group {
            display: flex;
            gap: 6px;
        }

        @media (max-width: 768px) {
            .btn-group {
                display: flex;
                gap: 4px;
            }
        }

        @media (min-width: 769px) {
            .btn-group {
                display: flex;
                gap: 8px;
            }
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
                            <h5 class="card-title mb-0">Data Penjualan</h5>
                            <a href="tambah_penjualan.php" class="btn btn-primary"
                                style="font-size: 14px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-plus" style="font-size: 14px;"></i> Tambah
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nomor Faktur</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Kasir</th>
                                            <th scope="col">Pembeli</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Varian</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jml</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Pembayaran</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';

                                        $sql = "SELECT 
                                            p.id_penjualan, 
                                            f.kode_penjualan,  
                                            p.tanggal, 
                                            p.id_user,
                                            p.nama_pembeli,
                                            p.no_hp,
                                            p.id_varian, 
                                            p.harga_jual,
                                            p.jumlah, 
                                            p.total_harga, 
                                            p.metode_pembayaran, 
                                            u.nama AS nama_user, 
                                            prod.nama_hp, 
                                            v.ram, 
                                            v.warna, 
                                            v.penyimpanan,
                                            v.kondisi
                                        FROM penjualan p
                                        JOIN faktur_penjualan f ON p.id_faktur = f.id_faktur
                                        JOIN varian v ON p.id_varian = v.id_varian
                                        JOIN produk prod ON v.id_produk = prod.id_produk
                                        JOIN users u ON p.id_user = u.id_user
                                        ORDER BY p.tanggal DESC, f.kode_penjualan DESC";

                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                        <th scope='row'>" . $no++ . "</th>
                                                        <td>" . $row['kode_penjualan'] . "</td>
                                                        <td>" . date('d-m-Y', strtotime($row['tanggal'])) . "</td>
                                                        <td>" . $row['nama_user'] . "</td>
                                                        <td>" . $row['nama_pembeli'] . "</td> 
                                                        <td>" . $row['no_hp'] . "</td>
                                                        <td>" . $row['nama_hp'] . " / " . $row['ram'] . " / " . $row['penyimpanan'] . " / " . $row['warna'] . " / " . ucfirst($row['kondisi']) . "</td>
                                                        <td>" . number_format($row['harga_jual'], 0, ',', '.') . "</td>
                                                        <td>" . $row['jumlah'] . "</td>
                                                        <td>" . number_format($row['total_harga'], 0, ',', '.') . "</td>
                                                        <td>" . $row['metode_pembayaran'] . "</td>
                                                        <td>
                                                            <div class='btn-group' role='group'>
                                                                <a href='print_nota.php?id=" . $row['id_penjualan'] . "' class='btn btn-outline-success btn-sm'>
                                                                    <i class='fas fa-print'></i>
                                                                </a>
                                                                <a href='edit_penjualan.php?id=" . $row['id_penjualan'] . "' class='btn btn-outline-primary btn-sm'>
                                                                    <i class='fas fa-pencil-alt'></i>
                                                                </a>
                                                                <button class='btn btn-outline-danger btn-sm' onclick='confirmDelete(" . $row['id_penjualan'] . ")'>
                                                                    <i class='fas fa-trash'></i>
                                                                </button>
                                                                <button class='btn btn-outline-warning btn-sm' onclick='confirmBatalkan(" . $row['id_penjualan'] . ")'>
                                                                    <i class='fas fa-undo'></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='10' class='text-center'>No data available</td></tr>";
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

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom Scripts -->
    <script src="../js/script.js"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": []
            });
        });

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'hapus_penjualan.php?id=' + id;
            }
        }

        function confirmBatalkan(id_penjualan) {
            if (confirm("Apakah Anda yakin ingin membatalkan penjualan ini?")) {
                window.location.href = 'batalkan_penjualan.php?id=' + id_penjualan;
            }
        }
    </script>
</body>

</html>