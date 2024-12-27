<?php
include 'koneksi.php';

// Ambil data dari form
$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password']; // Password mungkin kosong, jadi perlu penanganan
$role = $_POST['role'];

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Jika password diisi, maka update password, jika tidak, password tetap
if (!empty($password)) {
    // Update query dengan password baru
    $sql = "UPDATE users SET nama = ?, username = ?, password = ?, role = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    // Hash password sebelum disimpan
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("ssssi", $nama, $username, $hashed_password, $role, $id_user);
} else {
    // Update query tanpa mengganti password
    $sql = "UPDATE users SET nama = ?, username = ?, role = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $username, $role, $id_user);
}

// Cek apakah statement berhasil dipersiapkan
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Eksekusi statement
if ($stmt->execute()) {
    echo '<script>alert("Akun berhasil diperbarui."); window.location.href="akun.php";</script>';
} else {
    echo '<script>alert("Error: ' . $stmt->error . '"); window.location.href="akun.php";</script>';
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>