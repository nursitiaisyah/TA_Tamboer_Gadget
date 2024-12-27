<?php
session_start();
include 'koneksi.php'; // Pastikan Anda menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['reset_code'])) {
        die("Error: Kode harus diisi.");
    }

    $reset_code = $_POST['reset_code'];

    // Cek apakah kode valid
    if ($reset_code == $_SESSION['kode_verifikasi']) {
        // Kode valid, lanjutkan untuk reset password
        echo "Kode valid. Silakan atur ulang password Anda.";
        // Anda bisa mengarahkan pengguna ke halaman reset password di sini
        header("Location: reset_password.php");
        exit();
    } else {
        echo "Kode tidak valid.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Kode</title>
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
        <h2>Verifikasi Kode Reset Password</h2>
        <form method="post" action="">
            <div class="input-group">
                <label for="reset_code">Kode Reset:</label>
                <input type="text" name="reset_code" required placeholder="Masukkan kode reset">
            </div>
            <button type="submit" class="btn">Verifikasi Kode</button>
        </form>
    </div>
</body>

</html>