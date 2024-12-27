<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pegawai</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

        .register-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .register-container h2 {
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-align: center;
            color: #333;
        }

        .register-container .input-group {
            margin-bottom: 1rem;
        }

        .register-container .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .register-container .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .register-container .input-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .register-container .btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        .register-container .btn:hover {
            background-color: #0056b3;
        }

        .register-container .links {
            margin-top: 1rem;
            text-align: center;
        }

        .register-container .links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 0.5rem;
        }

        .register-container .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-container">
        <h2>Form Register Pegawai</h2>
        <form action="proses_register.php" method="POST">
            <div class="input-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <div class="links">
            <a href="login.php">Sudah punya akun? Login di sini</a>
        </div>
    </div>
</body>

</html>