<?php
include 'koneksi.php';

// Ambil data dari form
$id_varian = $_POST['id_varian'];
$id_produk = $_POST['id_produk'];
$ram = $_POST['ram'];
$warna = $_POST['warna'];
$penyimpanan = $_POST['penyimpanan'];
$kondisi = $_POST['kondisi'];  // Menambahkan kondisi dari form
$harga_masuk = $_POST['harga_masuk'];
$harga_jual = $_POST['harga_jual'];
$stok = $_POST['stok'];


// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk memperbarui data varian
$sql = "UPDATE varian SET id_produk = ?, ram = ?, warna = ?, penyimpanan = ?, kondisi = ?, harga_masuk = ?, harga_jual = ?, stok = ? WHERE id_varian = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("issssiiii", $id_produk, $ram, $warna, $penyimpanan, $kondisi, $harga_masuk, $harga_jual, $stok, $id_varian);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data varian berhasil diperbarui."); window.location.href="varian.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="varian.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>