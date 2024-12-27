<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Akun</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Custom styles for responsive tables */
        @media (max-width: 768px) {
            table.dataTable tbody td {
                font-size: 11px;
            }

            table.dataTable thead th {
                font-size: 11px;
            }
        }

        @media (min-width: 769px) {
            table.dataTable tbody td {
                font-size: 14px;
            }

            table.dataTable thead th {
                font-size: 14px;
            }
        }

        .btn-group {
            display: flex;
            gap: 6px;
        }

        @media (max-width: 768px) {
            .btn-group {
                display: flex;
                gap: 4px;
            }
        }

        @media (min-width: 769px) {
            .btn-group {
                display: flex;
                gap: 8px;
            }
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
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                        </div>
                    </div>

                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Data Akun</h5>
                            <a href="tambah_akun.php" class="btn btn-primary"
                                style="font-size: 14px; padding: 6px 12px; display: inline-flex; align-items: center; gap: 6px;">
                                <i class="fas fa-plus" style="font-size: 14px;"></i> Tambah
                            </a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="accountTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'koneksi.php';
                                        $sql = "SELECT * FROM users";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            $no = 1;
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                <th scope='row'>" . $no++ . "</th>
                                                <td>" . $row['nama'] . "</td>
                                                <td>" . $row['username'] . "</td>
                                                <td>" . ucfirst($row['role']) . "</td>
                                                <td>
                                                <div class='btn-group' role='group'>
                                                    <a href='edit_akun.php?id=" . $row['id_user'] . "' class='btn btn-outline-primary btn-sm'>
                                                        <i class='fas fa-pencil-alt'></i>
                                                    </a>
                                                    <button class='btn btn-outline-danger btn-sm' onclick='confirmDelete(" . $row['id_user'] . ")'>
                                                        <i class='fas fa-trash'></i>
                                                    </button>
                                                </td>
                                                </div>
                                            </tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5' class='text-center'>No data available</td></tr>";
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
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
    <script>
        $(document).ready(function () {
            $('#accountTable').DataTable({
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "order": []
            });
        });

        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                window.location.href = 'hapus_akun.php?id=' + id;
            }
        }
    </script>
</body>

</html>