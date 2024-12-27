<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $role = 'pegawai'; // Role otomatis sebagai pegawai
    $created_at = date('Y-m-d H:i:s');
    $updated_at = $created_at;

    // Periksa apakah username atau email sudah ada
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $checkQuery->bind_param("ss", $username, $email);
    $checkQuery->execute();
    $result = $checkQuery->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username atau email sudah terdaftar.');</script>";
    } else {
        // Masukkan data ke database
        $query = $conn->prepare("INSERT INTO users (nama, username, email, password, role, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssssss", $nama, $username, $email, $password, $role, $created_at, $updated_at);

        if ($query->execute()) {
            echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan: " . $query->error . "');</script>";
        }
    }
}
?>