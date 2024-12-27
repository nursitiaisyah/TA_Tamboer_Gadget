<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi database sudah benar

// Cek apakah pengguna sudah memverifikasi kode
if (!isset($_SESSION['kode_verifikasi'])) {
    header("Location: lupa_password.php"); // Redirect jika belum memverifikasi
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password_baru = $_POST['password_baru'];
    $password_konfirmasi = $_POST['password_konfirmasi'];

    // Cek apakah password baru dan konfirmasi sama
    if ($password_baru === $password_konfirmasi) {
        // Hash password baru
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

        // Update password di database
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $password_hash, $email);

        if ($stmt->execute()) {
            // Hapus sesi setelah berhasil mereset password
            session_unset();
            session_destroy();
            echo "<script>alert('Password berhasil direset. Silakan login.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Gagal mereset password. Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Password baru dan konfirmasi tidak sama.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .container h2 {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="password_baru">Password Baru</label>
                <input type="password" id="password_baru" name="password_baru" placeholder="Masukkan password baru"
                    required>
            </div>
            <div class="input-group">
                <label for="password_konfirmasi">Konfirmasi Password</label>
                <input type="password" id="password_konfirmasi" name="password_konfirmasi"
                    placeholder="Konfirmasi password baru" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</body>

</html>