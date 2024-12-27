<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
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
                    <div class="row"></div>
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Edit Produk</h5>
                        </div>
                        <!-- Form Element -->
                        <div class="card border-0">
                            <div class="card-body">
                                <?php
                                include 'koneksi.php';
                                $id = $_GET['id'];
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                $sql = "SELECT * FROM produk Where id_produk = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                } else {
                                    die("Data produk tidak ditemukan.");
                                }
                                $stmt->close();
                                $conn->close();
                                ?>

                                <form action="proses_edit_produk.php" method="POST">
                                    <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">

                                    <!-- Nama HP -->
                                    <div class="form-group">
                                        <label for="nama_hp" class="form-label">Nama HP</label>
                                        <input type="text" class="form-control form-control-sm" id="nama_hp"
                                            name="nama_hp" value="<?php echo $row['nama_hp']; ?>" required>
                                    </div>

                                    <!-- Merek -->
                                    <div class="form-group">
                                        <label for="merek" class="form-label">Merek</label>
                                        <input type="text" class="form-control form-control-sm" id="merek" name="merek" value="<?php echo $row['merek']; ?>"
                                            required>
                                    </div>

                                    <!-- Model -->
                                    <div class="form-group">
                                        <label for="model" class="form-label">Model</label>
                                        <input type="text" class="form-control form-control-sm" id="model" name="model" value="<?php echo $row['model']; ?>"
                                            required>
                                    </div>
                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-start">
                                        <button type="button" class="btn btn-secondary me-2"
                                            onclick="window.history.back()" style="font-size: 14px;">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </button>
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