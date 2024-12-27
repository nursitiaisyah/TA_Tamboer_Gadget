<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi database sudah benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Cek apakah email terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate kode verifikasi 6 digit
        $kode_verifikasi = rand(100000, 999999);
        $_SESSION['kode_verifikasi'] = $kode_verifikasi;
        $_SESSION['email'] = $email;

        // Kirim email menggunakan mail()
        $to = $email;
        $subject = "Kode Verifikasi Lupa Password";
        $message = "Kode verifikasi Anda adalah: " . $kode_verifikasi;
        $headers = "From: nur617859@gmail.com"; // Ganti dengan email Anda

        if (mail($to, $subject, $message, $headers)) {
            header("Location: verifikasi_kode.php");
            exit();
        } else {
            echo "<script>alert('Gagal mengirim email. Silakan coba lagi.');</script>";
        }
    } else {
        echo "<script>alert('Email tidak terdaftar.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
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
        <h2>Lupa Password</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email terdaftar" required>
            </div>
            <button type="submit" class="btn">Kirim</button>
        </form>
    </div>
</body>

</html>