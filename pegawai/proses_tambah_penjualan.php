<?php
include 'koneksi.php';

// Periksa apakah permintaan berasal dari tombol "Simpan"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $tanggal = $_POST['tanggal'];
    $id_varian = $_POST['id_varian'];
    $nama_pembeli = $_POST['nama_pembeli'];
    $no_hp = $_POST['no_hp'];
    $jumlah = $_POST['jumlah'];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $id_user = $_POST['id_user'];
    $harga_jual = floatval(str_replace(['Rp.', ','], '', $_POST['harga_jual']));
    $total_harga = floatval(str_replace(['Rp.', ','], '', $_POST['total_harga']));

    // Periksa stok
    $query_stok = "SELECT stok FROM varian WHERE id_varian = ?";
    $stmt_stok = $conn->prepare($query_stok);
    $stmt_stok->bind_param('i', $id_varian);
    $stmt_stok->execute();
    $result_stok = $stmt_stok->get_result();
    $row_stok = $result_stok->fetch_assoc();

    if ($row_stok['stok'] >= $jumlah) {
        // Buat kode penjualan hanya ketika tombol "Simpan" diklik
        $query_kode = "SELECT kode_penjualan FROM faktur_penjualan ORDER BY id_faktur DESC LIMIT 1";
        $result_kode = $conn->query($query_kode);

        if ($result_kode->num_rows > 0) {
            $row_kode = $result_kode->fetch_assoc();
            $last_number = (int) substr($row_kode['kode_penjualan'], -4); // Ambil 4 digit terakhir
            $new_number = $last_number + 1;
        } else {
            $new_number = 1; // Jika belum ada, mulai dari 1
        }
        $formatted_number = str_pad($new_number, 4, '0', STR_PAD_LEFT); // Format menjadi 4 digit
        $kode_penjualan = "PNJ$formatted_number"; // Format akhir

        // Masukkan data ke faktur_penjualan
        $sql_faktur = "INSERT INTO faktur_penjualan (kode_penjualan) VALUES (?)";
        $stmt_faktur = $conn->prepare($sql_faktur);
        $stmt_faktur->bind_param('s', $kode_penjualan);

        if ($stmt_faktur->execute()) {
            // Masukkan data ke penjualan
            $sql_penjualan = "INSERT INTO penjualan (id_faktur, tanggal, id_user, nama_pembeli, no_hp, id_varian, harga_jual, jumlah, total_harga, metode_pembayaran)
                              VALUES ((SELECT id_faktur FROM faktur_penjualan WHERE kode_penjualan = ?), ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_penjualan = $conn->prepare($sql_penjualan);
            $stmt_penjualan->bind_param('ssissiidss', $kode_penjualan, $tanggal, $id_user, $nama_pembeli, $no_hp, $id_varian, $harga_jual, $jumlah, $total_harga, $metode_pembayaran);

            if ($stmt_penjualan->execute()) {
                // Update stok
                $new_stok = $row_stok['stok'] - $jumlah;
                $sql_update_stok = "UPDATE varian SET stok = ? WHERE id_varian = ?";
                $stmt_update_stok = $conn->prepare($sql_update_stok);
                $stmt_update_stok->bind_param('ii', $new_stok, $id_varian);
                $stmt_update_stok->execute();

                echo '<script>alert("Data penjualan berhasil ditambahkan dengan kode: ' . $kode_penjualan . '"); window.location.href="penjualan.php";</script>';
            } else {
                echo '<script>alert("Gagal menambahkan data penjualan."); window.location.href="tambah_penjualan.php";</script>';
            }
        } else {
            echo '<script>alert("Gagal menambahkan faktur penjualan."); window.location.href="tambah_penjualan.php";</script>';
        }
    } else {
        echo '<script>alert("Stok tidak mencukupi."); window.location.href="tambah_penjualan.php";</script>';
    }
} else {
    echo '<script>alert("Tidak ada data yang dikirimkan."); window.location.href="tambah_penjualan.php";</script>';
}

$conn->close();
?>