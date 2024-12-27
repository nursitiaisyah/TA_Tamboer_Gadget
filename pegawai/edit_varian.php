<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Varian</title>
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
                            <h5 class="card-title mb-1">Edit Varian</h5>
                        </div>
                        <!-- Form Element -->
                        <div class="card border-0">
                            <div class="card-body">
                                <?php
                                // Include koneksi database
                                include 'koneksi.php';
                                // Ambil id_varian dari URL
                                $id_varian = $_GET['id'];
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Ambil data varian dari database
                                $query = "SELECT * FROM varian WHERE id_varian = '$id_varian'";
                                $result = mysqli_query($conn, $query);
                                $varian = mysqli_fetch_assoc($result);
                                ?>
                                <form action="proses_edit_varian.php" method="POST">
                                    <input type="hidden" name="id_varian" value="<?php echo $varian['id_varian']; ?>">

                                    <!-- Nama HP (Dropdown) -->
                                    <div class="form-group">
                                        <label for="nama_hp" class="form-label">Nama HP</label>
                                        <select class="form-control form-control-sm" id="nama_hp" name="id_produk"
                                            required>
                                            <option value="" disabled>Pilih HP</option>
                                            <?php
                                            // Ambil data produk dari database
                                            $query = "SELECT id_produk, nama_hp FROM produk";
                                            $result = mysqli_query($conn, $query);

                                            // Cek jika ada data produk
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Menandai produk yang dipilih
                                                    $selected = ($row['id_produk'] == $varian['id_produk']) ? 'selected' : '';
                                                    echo "<option value='" . $row['id_produk'] . "' $selected>" . $row['nama_hp'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='' disabled>Tidak ada data produk</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- RAM -->
                                    <div class="form-group">
                                        <label for="ram" class="form-label">RAM</label>
                                        <input type="text" class="form-control form-control-sm" id="ram" name="ram"
                                            value="<?php echo $varian['ram']; ?>" required>
                                    </div>

                                    <!-- Warna -->
                                    <div class="form-group">
                                        <label for="warna" class="form-label">Warna</label>
                                        <input type="text" class="form-control form-control-sm" id="warna" name="warna"
                                            value="<?php echo $varian['warna']; ?>" required>
                                    </div>

                                    <!-- Penyimpanan -->
                                    <div class="form-group">
                                        <label for="penyimpanan" class="form-label">Penyimpanan</label>
                                        <input type="text" class="form-control form-control-sm" id="penyimpanan"
                                            name="penyimpanan" value="<?php echo $varian['penyimpanan']; ?>" required>
                                    </div>

                                    <!-- Kondisi -->
                                    <div class="form-group">
                                        <label for="kondisi" class="form-label">Kondisi</label>
                                        <select class="form-control form-control-sm" id="kondisi" name="kondisi"
                                            required>
                                            <option value="baru" <?php echo ($varian['kondisi'] == 'baru') ? 'selected' : ''; ?>>Baru</option>
                                            <option value="bekas" <?php echo ($varian['kondisi'] == 'bekas') ? 'selected' : ''; ?>>Bekas</option>
                                        </select>
                                    </div>
                                    
                                    <!-- Harga Masuk -->
                                    <div class="form-group">
                                        <label for="harga_masuk" class="form-label">Harga Masuk</label>
                                        <input type="number" class="form-control form-control-sm" id="harga_masuk"
                                            name="harga_masuk" value="<?php echo $varian['harga_masuk']; ?>" required style="max-width: 140px;">
                                    </div>

                                    <!-- Harga Jual -->
                                    <div class="form-group">
                                        <label for="harga_jual" class="form-label">Harga Jual</label>
                                        <input type="number" class="form-control form-control-sm" id="harga_jual"
                                            name="harga_jual" value="<?php echo $varian['harga_jual']; ?>" required style="max-width: 140px;">
                                    </div>

                                    <!-- Stok -->
                                    <div class="form-group">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control form-control-sm" id="stok" name="stok"
                                            value="<?php echo $varian['stok']; ?>" required style="max-width: 70px;">
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