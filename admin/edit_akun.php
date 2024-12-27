<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Akun</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-label {
            min-width: 110px;
            font-weight: bold;
        }

        .form-control-sm {
            max-width: 300px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main">
            <!-- Navbar -->
            <?php include 'navbar.php'; ?>

            <!-- Main Content Area -->
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row"></div>
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-1">Edit Akun</h5>
                        </div>
                        <!-- Form Element -->
                        <div class="card border-0">
                            <div class="card-body">
                                <?php
                                // Include koneksi database
                                include 'koneksi.php';
                                // Ambil id_user dari URL
                                $id_user = $_GET['id'];

                                // Ambil data akun dari database
                                $query = "SELECT * FROM users WHERE id_user = '$id_user'";
                                $result = mysqli_query($conn, $query);
                                $user = mysqli_fetch_assoc($result);
                                ?>
                                <form action="proses_edit_akun.php" method="POST">
                                    <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">

                                    <!-- Nama -->
                                    <div class="form-group">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control form-control-sm" id="nama" name="nama"
                                            value="<?php echo $user['nama']; ?>" required>
                                    </div>

                                    <!-- Username -->
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" class="form-control form-control-sm" id="username"
                                            name="username" value="<?php echo $user['username']; ?>" required>
                                    </div>

                                    <!-- Password (Opsional) -->
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control form-control-sm" id="password"
                                            name="password">
                                    </div>

                                    <!-- Role -->
                                    <div class="form-group">
                                        <label for="role" class="form-label">Role</label>
                                        <select class="form-control form-control-sm" id="role" name="role" required>
                                            <option value="pemilik" <?php echo ($user['role'] == 'pemilik') ? 'selected' : ''; ?>>Pemilik</option>
                                            <option value="pegawai" <?php echo ($user['role'] == 'pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                        </select>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <div class="d-flex justify-content-start">
                                        <button type="button" class="btn btn-secondary me-2"
                                            onclick="window.history.back()" style="font-size: 14px;">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </button>
                                        <button type="submit" class="btn btn-primary" style="font-size: 14px;">
                                            <i class="fas fa-save"></i> Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom Scripts -->
    <script src="../js/script.js"></script>
</body>

</html>