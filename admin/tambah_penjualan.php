<?php
include 'koneksi.php'; // Pastikan koneksi database sudah benar 

session_start(); // Memulai sesi

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php"); // Redirect jika belum login
    exit();
}

// Ambil data nama dari sesi
$nama_pengguna = $_SESSION['nama']; // Nama pengguna yang login
$id_user = $_SESSION['id_user'];    // ID pengguna yang login

// Generate kode penjualan otomatis
$query_kode = "SELECT kode_penjualan FROM faktur_penjualan ORDER BY id_faktur DESC LIMIT 1";
$result_kode = $conn->query($query_kode);

if ($result_kode->num_rows > 0) {
    $row_kode = $result_kode->fetch_assoc();
    $last_number = (int) substr($row_kode['kode_penjualan'], -4); // Ambil 4 digit terakhir
    $new_number = $last_number + 1;
} else {
    $new_number = 1; // Jika belum ada data, mulai dari 1
}
$formatted_number = str_pad($new_number, 4, '0', STR_PAD_LEFT); // Format menjadi 4 digit
$kode_penjualan = "PNJ$formatted_number"; // Format akhir

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penjualan</title>
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
            width: 25%;
            /* Ubah lebar label sesuai kebutuhan */
            text-align: left;
            /* Atur teks label rata kiri */
            padding-right: 5px;
            /* Kurangi jarak antara label dan input */
            font-weight: bold;
        }

        .form-control {
            flex: 1;
            /* Biarkan input menyesuaikan lebar container */
            max-width: 70%;
            /* Tentukan batas lebar maksimal */
            margin-left: 5px;
            /* Tambahkan sedikit margin kiri jika diperlukan */
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
                            <h5 class="card-title mb-1">Tambah Penjualan</h5>
                        </div>
                        <div class="card-body">
                            <form action="proses_tambah_penjualan.php" method="POST">
                                <div class="row">
                                    <!-- Kolom 1 -->
                                    <div class="col-md-6">
                                        <!-- Kode Penjualan -->
                                        <div class="form-group">
                                            <label for="kode_penjualan" class="form-label">Nomor Faktur</label>
                                            <input type="text" name="kode_penjualan" id="kode_penjualan"
                                                class="form-control form-control-sm"
                                                value="<?php echo $kode_penjualan; ?>" readonly
                                                style="max-width: 135px; background-color: #e9ecef; cursor: not-allowed;">
                                        </div>
                                        <!-- Tanggal -->
                                        <div class="form-group">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control form-control-sm" id="tanggal"
                                                name="tanggal" required style="max-width: 130px;">
                                        </div>
                                        <!-- Pengguna/Sales/Kasir -->
                                        <div class="form-group">
                                            <label for="pengguna" class="form-label">Kasir</label>
                                            <input type="text" name="pengguna" id="pengguna"
                                                class="form-control form-control-sm"
                                                value="<?php echo htmlspecialchars($nama_pengguna); ?>" readonly
                                                style="max-width: 150px; background-color: #e9ecef; cursor: not-allowed;">
                                            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                        </div>
                                        <!-- Nama Pembeli -->
                                        <div class="form-group">
                                            <label for="nama_pembeli" class="form-label">Pembeli</label>
                                            <input type="text" name="nama_pembeli" id="nama_pembeli"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <!-- No HP -->
                                        <div class="form-group">
                                            <label for="no_hp" class="form-label">No HP</label>
                                            <input type="tel" name="no_hp" id="no_hp"
                                                class="form-control form-control-sm" pattern="^\d{1,15}$" maxlength="15"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required
                                                style="max-width: 140px;">
                                        </div>
                                    </div>
                                    <!-- Kolom 2 -->
                                    <div class="col-md-6">
                                        <!-- Kategori HP -->
                                        <div class="form-group">
                                            <label for="kategori_hp" class="form-label">Kategori HP</label>
                                            <select name="kategori_hp" id="kategori_hp"
                                                class="form-control form-control-sm" required style="max-width: 130px;">
                                                <option value="">Pilih Kategori</option>
                                                <?php
                                                include 'koneksi.php';
                                                $sql_merek = "SELECT DISTINCT merek FROM produk";
                                                $result_merek = $conn->query($sql_merek);
                                                if ($result_merek->num_rows > 0) {
                                                    while ($row_merek = $result_merek->fetch_assoc()) {
                                                        echo "<option value='" . $row_merek['merek'] . "'>" . $row_merek['merek'] . "</option>";
                                                    }
                                                }


                                                ?>
                                            </select>
                                        </div>
                                        <!-- Varian Produk -->
                                        <div class="form-group">
                                            <label for="id_varian" class="form-label">Varian</label>
                                            <select name="id_varian" id="id_varian" class="form-control form-control-sm"
                                                required>
                                                <option value="">Pilih Varian</option>
                                            </select>
                                        </div>
                                        <!-- Harga Jual -->
                                        <div class="form-group">
                                            <label for="harga_jual" class="form-label">Harga Jual</label>
                                            <input type="text" name="harga_jual" id="harga_jual"
                                                class="form-control form-control-sm" readonly
                                                style="max-width: 140px; background-color: #e9ecef; cursor: not-allowed;">
                                        </div>
                                        <!-- Jumlah -->
                                        <div class="form-group">
                                            <label for="jumlah" class="form-label">Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah"
                                                class="form-control form-control-sm" min="1" required
                                                style="max-width: 70px;">
                                        </div>
                                        <!-- Total Harga -->
                                        <div class="form-group">
                                            <label for="total_harga" class="form-label">Total Harga</label>
                                            <input type="text" name="total_harga" id="total_harga"
                                                class="form-control form-control-sm" readonly
                                                style="max-width: 140px; background-color: #e9ecef; cursor: not-allowed;">
                                        </div>
                                        <!-- Metode Pembayaran -->
                                        <div class="form-group">
                                            <label for="metode_pembayaran" class="form-label">Pembayaran</label>
                                            <select name="metode_pembayaran" id="metode_pembayaran"
                                                class="form-control form-control-sm" required style="max-width: 200px;">
                                                <option value="">Pilih Metode Pembayaran</option>
                                                <option value="Tunai">Tunai</option>
                                                <option value="Transfer">Transfer</option>
                                            </select>
                                        </div>
                                        <!-- Tambahkan di dalam form -->
                                        <div class="form-group" id="uang_bayar_group" style="display: none;">
                                            <label for="uang_bayar" class="form-label">Uang Bayar</label>
                                            <input type="number" name="uang_bayar" id="uang_bayar"
                                                class="form-control form-control-sm" min="0" required>
                                        </div>
                                        <div class="form-group" id="kembalian_group" style="display: none;">
                                            <label for="kembalian" class="form-label">Kembalian</label>
                                            <input type="text" name="kembalian" id="kembalian"
                                                class="form-control form-control-sm" readonly
                                                style="background-color: #e9ecef; cursor: not-allowed;">
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="d-flex justify-content-start mt-3">
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
            // Mengisi varian berdasarkan merek yang dipilih
            $('#kategori_hp').change(function () {
                var merek = $(this).val();
                $('#id_varian').html('<option value="">Pilih Varian</option>'); // Reset varian

                if (merek) {
                    $.ajax({
                        url: 'get_varian_by_merek.php', // Skrip untuk mengambil varian
                        method: 'POST',
                        data: { merek: merek },
                        success: function (data) {
                            $('#id_varian').append(data); // Tambahkan opsi varian
                        }
                    });
                }
            });

            // Mengisi harga jual otomatis saat varian dipilih
            $('#id_varian').change(function () {
                var harga = $('#id_varian option:selected').data('harga');
                var stok = $('#id_varian option:selected').data('stok');

                if (harga && stok >= 1) {
                    $('#harga_jual').val('Rp. ' + harga.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
                    $('#jumlah').attr('max', stok); // Batas jumlah sesuai stok
                } else {
                    $('#harga_jual').val('');
                    $('#total_harga').val('');
                    $('#jumlah').attr('max', 0);
                }
            });

            // Menghitung total harga saat jumlah diisi
            $('#jumlah').change(function () {
                var jumlah = $(this).val();
                var harga = $('#id_varian option:selected').data('harga');

                if (jumlah > 0 && harga > 0) {
                    var total = jumlah * harga;
                    $('#total_harga').val(total); // Menyimpan total harga
                }
            });







            $(document).ready(function () {
                // Menampilkan atau menyembunyikan kolom Uang Bayar dan Kembalian
                $('#metode_pembayaran').change(function () {
                    if ($(this).val() === 'Tunai') {
                        $('#uang_bayar_group').show();
                        $('#kembalian_group').show();
                    } else {
                        $('#uang_bayar_group').hide();
                        $('#kembalian_group').hide();
                        $('#uang_bayar').val(''); // Reset nilai
                        $('#kembalian').val(''); // Reset nilai
                    }
                });

                // Menghitung kembalian
                $('#uang_bayar').on('input', function () {
                    var total_harga = parseFloat($('#total_harga').val().replace(/[^0-9.-]+/g, "")) || 0;
                    var uang_bayar = parseFloat($(this).val()) || 0;
                    var kembalian = uang_bayar - total_harga;
                    $('#kembalian').val(kembalian >= 0 ? kembalian : 0); // Tampilkan kembalian, tidak boleh negatif
                });
            });
        });
    </script>
</body>

</html>