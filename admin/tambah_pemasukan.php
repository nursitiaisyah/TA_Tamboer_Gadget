<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pemasukan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
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
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Tambah Pemasukan</h5>
                        </div>
                        <div class="card-body">
                            <form action="proses_tambah_pemasukan.php" method="POST">

                                <!-- Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control form-control-sm form-control-date"
                                        id="tanggal" name="tanggal" required style="max-width: 110px;">
                                </div>


                                <!-- Keterangan -->
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <!-- Label untuk input keterangan -->
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <!-- Input untuk keterangan (teks) -->
                                        <input type="text" class="form-control form-control-sm" id="keterangan"
                                            name="keterangan" required>
                                    </div>
                                </div>

                                <!-- Sumber Dana -->
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <!-- Label untuk input sumber dana -->
                                        <label for="sumber_dana" class="form-label">Sumber Dana</label>
                                        <!-- Input untuk sumber dana (teks) -->
                                        <input type="text" class="form-control form-control-sm" id="sumber_dana"
                                            name="sumber_dana" required>
                                    </div>
                                </div>

                                <!-- Jumlah -->
                                <div class="row mb-3">
                                    <div class="col-12 d-flex align-items-center">
                                        <!-- Label untuk input jumlah -->
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <!-- Input untuk jumlah (angka, dengan langkah 0.01) -->
                                        <input type="number" step="0.01"
                                            class="form-control form-control-sm form-control-amount" id="jumlah"
                                            name="jumlah" required>
                                    </div>
                                </div>


                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-start">
                                    <!-- Tombol Kembali -->
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()"
                                        style="font-size: 14px;">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </button>
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
</body>

</html>