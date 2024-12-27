<?php
include 'koneksi.php';

// Ambil data dari form
$id_penjualan = $_POST['id_penjualan'];
$tanggal = $_POST['tanggal'];
$nama_pembeli = $_POST['nama_pembeli'];
$no_hp = $_POST['no_hp'];
$id_varian = $_POST['id_varian'];
$harga_jual = $_POST['harga_jual'];
$jumlah = $_POST['jumlah'];
$total_harga = $harga_jual * $jumlah; // Menghitung total harga
$metode_pembayaran = $_POST['metode_pembayaran'];

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Persiapkan SQL query untuk memperbarui data penjualan
$sql = "UPDATE penjualan 
        SET 
            tanggal = ?, 
            nama_pembeli = ?, 
            no_hp = ?, 
            id_varian = ?, 
            harga_jual = ?, 
            jumlah = ?, 
            total_harga = ?, 
            metode_pembayaran = ? 
        WHERE id_penjualan = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param(
    "sssidiisi",
    $tanggal,
    $nama_pembeli,
    $no_hp,
    $id_varian,
    $harga_jual,
    $jumlah,
    $total_harga,
    $metode_pembayaran,
    $id_penjualan
);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data penjualan berhasil diperbarui."); window.location.href="penjualan.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="penjualan.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>