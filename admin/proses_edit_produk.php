<?php
include 'koneksi.php';

$id_produk = $_POST['id_produk'];
$nama_hp = $_POST['nama_hp'];
$merek = $_POST['merek'];
$model = $_POST['model'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE produk SET nama_hp = ?, merek = ?, model = ? WHERE id_produk = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param(
    "sssi",
    $nama_hp,
    $merek,
    $model,
    $id_produk
);
// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data produk berhasil diperbarui."); window.location.href="produk.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="produk.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
?>