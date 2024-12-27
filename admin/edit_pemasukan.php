<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemasukan</title>
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
                            <h5 class="card-title mb-1">Edit Pemasukan</h5>
                        </div>
                        <!-- Form Edit Pemasukan -->
                        <div class="card border-0">
                            <div class="card-body">
                                <?php
                                include 'koneksi.php';
                                // Ambil ID dari URL
                                $id = $_GET['id'];
                                // Ambil data untuk ditampilkan di form
                                $sql = "SELECT * FROM pemasukan WHERE id_pemasukan = ?";
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
                                <form action="proses_edit_pemasukan.php" method="POST">
                                    <input type="hidden" name="id_pemasukan"
                                        value="<?php echo htmlspecialchars($row['id_pemasukan']); ?>">
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
                                            name="keterangan" value="<?php echo $row['keterangan']; ?>" required>
                                    </div>
                                    <!-- Sumber Dana -->
                                    <div class="form-group">
                                        <label for="sumber_dana" class="form-label">Sumber Dana</label>
                                        <input type="text" class="form-control form-control-sm" id="sumber_dana"
                                            name="sumber_dana" value="<?php echo $row['sumber_dana']; ?>" required>
                                    </div>
                                    <!-- Jumlah -->
                                    <div class="form-group">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" step="0.01"
                                            class="form-control form-control-sm form-control-amount" id="jumlah"
                                            name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-start">
                                        <!-- Tombol Kembali -->
                                        <a href="pemasukan.php" class="btn btn-secondary me-2" style="font-size: 14px;">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <!-- Tombol Simpan -->
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
</body>

</html>