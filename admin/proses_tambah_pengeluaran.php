<?php
include 'koneksi.php'; // Pastikan file koneksi.php ada di folder yang sama atau sesuaikan path-nya

// Ambil data dari form
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
$jumlah = $_POST['jumlah'];
$harga_satuan = $_POST['harga_satuan'];

// Total harga dihitung berdasarkan jumlah dan harga_satuan
$total_harga = $jumlah * $harga_satuan;

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Persiapkan SQL query untuk menyimpan data
$sql = "INSERT INTO pengeluaran (tanggal, keterangan, jumlah, harga_satuan, total_harga) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind data ke statement
$stmt->bind_param("ssids", $tanggal, $keterangan, $jumlah, $harga_satuan, $total_harga);

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Data pengeluaran berhasil ditambahkan."); window.location.href="pengeluaran.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="index.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>