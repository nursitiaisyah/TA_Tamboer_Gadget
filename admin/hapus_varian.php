<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil ID varian dari URL
$id_varian = $_GET['id'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menghapus data varian
$sql = "DELETE FROM varian WHERE id_varian = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("i", $id_varian);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Varian berhasil dihapus."); window.location.href="varian.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="varian.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>