<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penjualan</title>
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
        <?php include 'sidebar.php'; ?>
        <div class="main">
            <?php include 'navbar.php'; ?>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="card border-0">
                        <div class="card-header">
                            <h5 class="card-title mb-1">Edit Penjualan</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            include 'koneksi.php';
                            $id_penjualan = $_GET['id'];
                            $query = "SELECT * FROM penjualan WHERE id_penjualan = '$id_penjualan'";
                            $result = mysqli_query($conn, $query);
                            $penjualan = mysqli_fetch_assoc($result);
                            ?>
                            <form action="proses_edit_penjualan.php" method="POST">
                                <input type="hidden" name="id_penjualan"
                                    value="<?php echo $penjualan['id_penjualan']; ?>">

                                <!-- Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal"
                                        value="<?php echo $penjualan['tanggal']; ?>" required style="max-width: 130px;">
                                </div>

                                <!-- Nama Pembeli -->
                                <div class="form-group">
                                    <label for="nama_pembeli" class="form-label">Nama Pembeli</label>
                                    <input type="text" class="form-control form-control-sm" id="nama_pembeli"
                                        name="nama_pembeli" value="<?php echo $penjualan['nama_pembeli']; ?>" required>
                                </div>

                                <!-- No HP -->
                                <div class="form-group">
                                    <label for="no_hp" class="form-label">No HP</label>
                                    <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp"
                                        value="<?php echo $penjualan['no_hp']; ?>" required style="max-width: 140px;">
                                </div>



                                <!-- Varian (Dropdown) -->
                                <div class="form-group">
                                    <label for="id_varian" class="form-label">Varian</label>
                                    <select class="form-control form-control-sm" id="id_varian" name="id_varian"
                                        required>
                                        <option value="" disabled>Pilih Varian</option>
                                        <?php
                                        // Ambil data varian dari database
                                        $query = "SELECT v.id_varian, prod.nama_hp, v.ram, v.warna, v.penyimpanan, v.kondisi 
                                                      FROM varian v 
                                                      JOIN produk prod ON v.id_produk = prod.id_produk";
                                        $result = mysqli_query($conn, $query);

                                        // Cek jika ada data varian
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $selected = ($row['id_varian'] == $penjualan['id_varian']) ? 'selected' : '';
                                                echo "<option value='" . $row['id_varian'] . "' $selected>" .
                                                    $row['nama_hp'] . " / " . $row['ram'] . " / " . $row['penyimpanan'] . " / " . $row['warna'] . " / " . ucfirst($row['kondisi']) .
                                                    "</option>";
                                            }
                                        } else {
                                            echo "<option value='' disabled>Tidak ada data varian</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Harga Jual -->
                                <div class="form-group">
                                    <label for="harga_jual" class="form-label">Harga Jual</label>
                                    <input type="number" class="form-control form-control-sm" id="harga_jual"
                                        name="harga_jual" value="<?php echo $penjualan['harga_jual']; ?>" readonly
                                        style="max-width: 140px; background-color: #e9ecef;">
                                </div>

                                <!-- Jumlah -->
                                <div class="form-group">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control form-control-sm" id="jumlah" name="jumlah"
                                        value="<?php echo $penjualan['jumlah']; ?>" required style="max-width: 70px;">
                                </div>

                                <!-- Total Harga -->
                                <div class="form-group">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" class="form-control form-control-sm" id="total_harga"
                                        name="total_harga" value="<?php echo $penjualan['total_harga']; ?>" readonly
                                        style="max-width: 140px; background-color: #e9ecef;">
                                </div>

                                <?php
                                $metode_pembayaran = isset($penjualan['metode_pembayaran']) ? $penjualan['metode_pembayaran'] : ''; // Default kosong jika tambah
                                ?>
                                <div class="form-group">
                                    <label for="metode_pembayaran" class="form-label">Pembayaran</label>
                                    <select class="form-control form-control-sm" id="metode_pembayaran"
                                        name="metode_pembayaran" required style="max-width: 200px;">
                                        <option value="Tunai" <?php echo ($metode_pembayaran === 'Tunai') ? 'selected' : ''; ?>>Tunai</option>
                                        <option value="Transfer" <?php echo ($metode_pembayaran === 'Transfer') ? 'selected' : ''; ?>>Transfer</option>
                                    </select>
                                </div>



                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-secondary me-2" onclick="window.history.back()"
                                        style="font-size: 14px;">
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
    <script>
        $(document).ready(function () {
            // Function to update total_harga based on harga_jual and jumlah
            function updateTotalHarga() {
                var hargaJual = parseFloat($('#harga_jual').val());
                var jumlah = parseInt($('#jumlah').val());
                if (!isNaN(hargaJual) && !isNaN(jumlah)) {
                    var totalHarga = hargaJual * jumlah;
                    $('#total_harga').val(totalHarga);
                }
            }

            // Update total harga when harga_jual or jumlah is changed
            $('#harga_jual, #jumlah').on('input', updateTotalHarga);
        });
    </script>
</body>

</html>