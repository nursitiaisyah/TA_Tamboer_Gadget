<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil ID user dari URL
$id_user = $_GET['id'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menghapus data akun
$sql = "DELETE FROM users WHERE id_user = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("i", $id_user);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Akun berhasil dihapus."); window.location.href="akun.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="akun.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>