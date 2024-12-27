<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$sumber_dana = $_POST['sumber_dana'];
$jumlah = $_POST['jumlah'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menyimpan data
$sql = "INSERT INTO pemasukan (tanggal, keterangan, sumber_dana, jumlah) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("sssd", $tanggal, $keterangan, $sumber_dana, $jumlah); // Menggunakan 'd' untuk tipe data decimal (jumlah)

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data berhasil disimpan."); window.location.href="pemasukan.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="index.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>