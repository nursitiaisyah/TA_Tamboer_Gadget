<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$id_produk = $_POST['id_produk']; // id_produk yang dipilih dari dropdown atau input
$ram = $_POST['ram'];
$warna = $_POST['warna'];
$penyimpanan = $_POST['penyimpanan'];
$kondisi = $_POST['kondisi']; // Ambil nilai kondisi
$harga_masuk = $_POST['harga_masuk'];
$harga_jual = $_POST['harga_jual'];
$stok = $_POST['stok'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menyimpan data varian
$sql = "INSERT INTO varian (id_produk, ram, warna, penyimpanan, kondisi, harga_masuk, harga_jual, stok) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("ssssssss", $id_produk, $ram, $warna, $penyimpanan, $kondisi, $harga_masuk, $harga_jual, $stok);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data varian berhasil disimpan."); window.location.href="varian.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="tambah_varian.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>