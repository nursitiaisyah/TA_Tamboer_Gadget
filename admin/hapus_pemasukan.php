<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil ID dari URL
$id = $_GET['id'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menghapus data
$sql = "DELETE FROM pemasukan WHERE id_pemasukan = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("i", $id);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data berhasil dihapus."); window.location.href="pemasukan.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="pemasukan.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>