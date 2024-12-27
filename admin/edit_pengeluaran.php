<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengeluaran</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-label {
            min-width: 110px;
            font-weight: bold;
        }

        .form-control-sm {
            max-width: 300px;
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
                    <div class="row"></div>
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Edit Pengeluaran</h5>
                        </div>

                        <!-- Form Edit Pengeluaran -->
                        <div class="card border-0">
                            <div class="card-body">
                                <?php
                                include 'koneksi.php';

                                // Ambil ID dari URL
                                $id = $_GET['id'];

                                // Ambil data untuk ditampilkan di form
                                $sql = "SELECT * FROM pengeluaran WHERE id_pengeluaran = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                } else {
                                    die("Data tidak ditemukan.");
                                }

                                $stmt->close();
                                ?>

                                <form action="proses_edit_pengeluaran.php" method="POST">
                                    <input type="hidden" name="id_pengeluaran"
                                        value="<?php echo htmlspecialchars($row['id_pengeluaran']); ?>">

                                    <!-- Tanggal -->
                                    <div class="form-group">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" class="form-control form-control-sm form-control-date"
                                            id="tanggal" name="tanggal"
                                            value="<?php echo htmlspecialchars($row['tanggal']); ?>" required
                                            style="max-width: 110px;">
                                    </div>
                                    <!-- Keterangan -->
                                    <div class="form-group">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control form-control-sm" id="keterangan"
                                            name="keterangan"
                                            value="<?php echo htmlspecialchars($row['keterangan']); ?>" required>
                                    </div>
                                    <!-- Jumlah -->
                                    <div class="form-group">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control form-control-sm" id="jumlah"
                                            name="jumlah" value="<?php echo htmlspecialchars($row['jumlah']); ?>"
                                            required style="max-width: 70px;">
                                    </div>
                                    <!-- Harga Satuan -->
                                    <div class="form-group">
                                        <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                        <input type="number" class="form-control form-control-sm" id="harga_satuan"
                                            name="harga_satuan"
                                            value="<?php echo htmlspecialchars($row['harga_satuan']); ?>" required
                                            style="max-width: 140px;">
                                    </div>
                                    <!-- Total Harga -->
                                    <div class="form-group">
                                        <label for="total_harga" class="form-label">Total Harga</label>
                                        <input type="number" class="form-control form-control-sm" id="total_harga"
                                            name="total_harga"
                                            value="<?php echo htmlspecialchars($row['total_harga']); ?>" readonly
                                            style="max-width: 140px; background-color: #e9ecef; cursor: not-allowed;">
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-start">
                                        <a href="pengeluaran.php" class="btn btn-secondary me-2"
                                            style="font-size: 14px;">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" style="font-size: 14px;">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0"></p>
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
    <!-- Custom JS -->
    <script src="../js/script.js"></script>
    <script>
        document.getElementById('jumlah').addEventListener('input', updateTotalHarga);
        document.getElementById('harga_satuan').addEventListener('input', updateTotalHarga);

        function updateTotalHarga() {
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            const hargaSatuan = parseInt(document.getElementById('harga_satuan').value) || 0;

            const totalHarga = jumlah * hargaSatuan;
            document.getElementById('total_harga').value = totalHarga;
        }

        // Initialize the values on page load
        window.onload = updateTotalHarga;
    </script>
</body>

</html>