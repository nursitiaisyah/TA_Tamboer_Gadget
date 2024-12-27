<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$nama_hp = $_POST['nama_hp'];
$merek = $_POST['merek'];
$model = $_POST['model'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menyimpan data
$sql = "INSERT INTO produk (nama_hp, merek, model) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("sss", $nama_hp, $merek, $model);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data produk berhasil disimpan."); window.location.href="produk.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="tambah_produk.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>