<?php
include 'koneksi.php';

// Ambil data dari form
$id_pengeluaran = $_POST['id_pengeluaran'];
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$jumlah = $_POST['jumlah'];
$harga_satuan = $_POST['harga_satuan'];
$total_harga = $harga_satuan * $jumlah;  // Menghitung total harga

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk memperbarui data pengeluaran
$sql = "UPDATE pengeluaran SET tanggal = ?, keterangan = ?, jumlah = ?, harga_satuan = ?, total_harga = ? WHERE id_pengeluaran = ?";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("ssiiii", $tanggal, $keterangan, $jumlah, $harga_satuan, $total_harga, $id_pengeluaran);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data pengeluaran berhasil diperbarui."); window.location.href="pengeluaran.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="pengeluaran.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>