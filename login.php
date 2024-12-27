<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-container h1 {
            margin-bottom: 1rem;
            font-weight: 700;
            text-align: center;
            color: #333;
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            font-weight: 700;
            text-align: center;
            color: #333;
        }

        .login-container .input-group {
            margin-bottom: 1rem;
        }

        .login-container .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .login-container .input-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .login-container .input-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .login-container .btn {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        .login-container .btn:hover {
            background-color: #0056b3;
        }

        .login-container .links {
            margin-top: 1rem;
            text-align: center;
        }

        .login-container .links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 0.5rem;
        }

        .login-container .links a:hover {
            text-decoration: underline;
        }

        .login-logo {
            display: block;
            margin: 1rem auto;
            width: 80px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img src="./image/logol1.png" alt="Logo" class="login-logo">
        <h1>Aplikasi Penjualan Tamboer Gadget</h1>
        <h2>Form Login</h2>
        <form action="proses_login.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="links">
            <a href="lupa_password.php">Lupa Password?</a>
            <span>|</span>
            <a href="register.php">Register</a>
        </div>
    </div>
</body>

</html>