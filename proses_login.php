<?php
session_start();
include 'koneksi.php';

// Validasi input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['username'], $_POST['password'])) {
        die("Error: Username dan password harus diisi.");
    }

    $username = $_POST['username'];
    $password = $_POST['password'];
} else {
    die("Invalid request method.");
}

// Query ke database
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Simpan data ke sesi
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];
        $_SESSION['role'] = $user['role'];

        // Redirect berdasarkan role
        if ($user['role'] == 'pemilik') {
            header("Location: admin/halaman_admin.php");
            exit();
        } elseif ($user['role'] == 'pegawai') {
            header("Location: pegawai/halaman_pegawai.php");
            exit();
        }
    } else {
        echo htmlspecialchars("Login failed. Invalid username or password.", ENT_QUOTES, 'UTF-8');
    }
} else {
    echo htmlspecialchars("Login failed. Invalid username or password.", ENT_QUOTES, 'UTF-8');
}

$stmt->close();
$conn->close();
?>