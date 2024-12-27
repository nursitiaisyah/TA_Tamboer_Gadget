<?php
include 'koneksi.php';

// Ambil id_penjualan dari URL
$id_penjualan = $_GET['id'];

// 1. Ambil data penjualan berdasarkan id_penjualan
$query_penjualan = "SELECT id_varian, jumlah FROM penjualan WHERE id_penjualan = ?";
$stmt_penjualan = $conn->prepare($query_penjualan);
$stmt_penjualan->bind_param('i', $id_penjualan);
$stmt_penjualan->execute();
$result_penjualan = $stmt_penjualan->get_result();
$row_penjualan = $result_penjualan->fetch_assoc();

$id_varian = $row_penjualan['id_varian'];
$jumlah = $row_penjualan['jumlah'];

// 2. Kembalikan stok di tabel varian
$query_update_stok = "UPDATE varian SET stok = stok + ? WHERE id_varian = ?";
$stmt_update_stok = $conn->prepare($query_update_stok);
$stmt_update_stok->bind_param('ii', $jumlah, $id_varian);
$stmt_update_stok->execute();

// 3. Hapus data penjualan dari tabel penjualan
$query_hapus_penjualan = "DELETE FROM penjualan WHERE id_penjualan = ?";
$stmt_hapus_penjualan = $conn->prepare($query_hapus_penjualan);
$stmt_hapus_penjualan->bind_param('i', $id_penjualan);

// Eksekusi penghapusan penjualan dan tampilkan notifikasi
if ($stmt_hapus_penjualan->execute()) {
    echo '<script>alert("Penjualan berhasil dibatalkan."); window.location.href="penjualan.php";</script>';
} else {
    echo '<script>alert("Gagal membatalkan penjualan."); window.location.href="penjualan.php";</script>';
}

// Tutup statement dan koneksi
$stmt_penjualan->close();
$stmt_update_stok->close();
$stmt_hapus_penjualan->close();
$conn->close();
?>