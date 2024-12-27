<?php
include 'koneksi.php'; // Pastikan file koneksi ada dan benar

if (isset($_POST['merek'])) {
    $merek = $_POST['merek'];
    // Query untuk mengambil varian berdasarkan merek dari tabel produk dan varian
    $query = "
        SELECT v.id_varian, CONCAT(p.nama_hp, ' ', v.ram, '/', v.penyimpanan, '/', v.warna, ' (', v.kondisi, ')') AS varian, v.harga_jual AS harga, v.stok
        FROM produk p
        JOIN varian v ON p.id_produk = v.id_produk
        WHERE p.merek = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $merek);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Buat opsi dengan data harga dan stok untuk JavaScript
            echo "<option value='" . $row['id_varian'] . "' data-harga='" . $row['harga'] . "' data-stok='" . $row['stok'] . "'>" . $row['varian'] . "</option>";
        }
    } else {
        echo "<option value=''>Tidak ada varian tersedia</option>";
    }
    $stmt->close();
}
?>