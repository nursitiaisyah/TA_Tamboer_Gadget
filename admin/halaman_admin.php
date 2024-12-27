<?php
include 'koneksi.php'; // Pastikan koneksi sudah benar

// Queries to fetch data for the cards (Total values)
$penjualanQuery = "SELECT SUM(total_harga) AS total_penjualan FROM penjualan";
$penjualanResult = $conn->query($penjualanQuery);
$totalPenjualan = $penjualanResult->num_rows > 0 ? $penjualanResult->fetch_assoc()['total_penjualan'] : 0;

$pengeluaranQuery = "SELECT SUM(total_harga) AS total_pengeluaran FROM pengeluaran";
$pengeluaranResult = $conn->query($pengeluaranQuery);
$totalPengeluaran = $pengeluaranResult->num_rows > 0 ? $pengeluaranResult->fetch_assoc()['total_pengeluaran'] : 0;

$pemasukanQuery = "SELECT SUM(jumlah) AS total_pemasukan FROM pemasukan";
$pemasukanResult = $conn->query($pemasukanQuery);
$totalPemasukan = $pemasukanResult->num_rows > 0 ? $pemasukanResult->fetch_assoc()['total_pemasukan'] : 0;

// Calculate keuntungan
$totalKeuntungan = $totalPemasukan - $totalPengeluaran;

// Queries to fetch daily data for the charts
$penjualanQueryDaily = "SELECT tanggal, SUM(total_harga) AS total_penjualan FROM penjualan GROUP BY tanggal";
$penjualanResultDaily = $conn->query($penjualanQueryDaily);
$penjualanData = [];
while ($row = $penjualanResultDaily->fetch_assoc()) {
    $penjualanData[] = $row;
}

$pemasukanQueryDaily = "SELECT tanggal, SUM(jumlah) AS total_pemasukan FROM pemasukan GROUP BY tanggal";
$pemasukanResultDaily = $conn->query($pemasukanQueryDaily);
$pemasukanData = [];
while ($row = $pemasukanResultDaily->fetch_assoc()) {
    $pemasukanData[] = $row;
}

$pengeluaranQueryDaily = "SELECT tanggal, SUM(total_harga) AS total_pengeluaran FROM pengeluaran GROUP BY tanggal";
$pengeluaranResultDaily = $conn->query($pengeluaranQueryDaily);
$pengeluaranData = [];
while ($row = $pengeluaranResultDaily->fetch_assoc()) {
    $pengeluaranData[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <!-- Row for Total Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Penjualan</h5>
                                    <p class="card-text" id="totalPenjualan">
                                        <?php echo number_format($totalPenjualan, 0); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pemasukan</h5>
                                    <p class="card-text" id="totalPemasukan">
                                        <?php echo number_format($totalPemasukan, 0); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Pengeluaran</h5>
                                    <p class="card-text" id="totalPengeluaran">
                                        <?php echo number_format($totalPengeluaran, 0); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-dark">
                                <div class="card-body">
                                    <h5 class="card-title">Total Keuntungan</h5>
                                    <p class="card-text" id="totalKeuntungan">
                                        <?php echo number_format($totalKeuntungan, 0); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row for Charts -->
                    <div class="row">
                        <!-- Penjualan Chart -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Penjualan Harian
                                </div>
                                <div class="card-body">
                                    <canvas id="penjualanChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Pengeluaran Chart -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Pengeluaran Harian
                                </div>
                                <div class="card-body">
                                    <canvas id="pengeluaranChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Pemasukan Chart -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    Pemasukan Harian
                                </div>
                                <div class="card-body">
                                    <canvas id="pemasukanChart"></canvas>
                                </div>
                            </div>
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
    <script>
        const penjualanData = <?php echo json_encode($penjualanData); ?>;
        const pengeluaranData = <?php echo json_encode($pengeluaranData); ?>;
        const pemasukanData = <?php echo json_encode($pemasukanData); ?>;

        const formatChartData = (data, label) => {
            return {
                labels: data.map(item => item.tanggal),
                datasets: [{
                    label: label,
                    data: data.map(item => item.total_penjualan || item.total_pengeluaran || item.total_pemasukan),
                    fill: true,
                    backgroundColor: (ctx) => {
                        const gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(75, 192, 192, 0.4)');
                        gradient.addColorStop(1, 'rgba(75, 192, 192, 0)');
                        return gradient;
                    },
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(255, 255, 255, 1)',
                    pointBorderColor: 'rgba(75, 192, 192, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointHoverBorderColor: 'rgba(220, 220, 220, 1)',
                    pointHoverBorderWidth: 2,
                }]
            };
        };

        const commonOptions = {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Tanggal' } },
                y: { title: { display: true, text: 'Jumlah' }, beginAtZero: true }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    titleFont: { size: 16 },
                    bodyFont: { size: 14 },
                    borderWidth: 2,
                    borderColor: 'rgba(220, 220, 220, 1)',
                    callbacks: {
                        label: (tooltipItem) => `Jumlah: ${tooltipItem.formattedValue}`
                    }
                }
            },
            interaction: { mode: 'index', intersect: false }
        };

        // Penjualan Chart
        const penjualanCtx = document.getElementById('penjualanChart').getContext('2d');
        new Chart(penjualanCtx, { type: 'line', data: formatChartData(penjualanData, 'Penjualan'), options: commonOptions });

        // Pengeluaran Chart
        const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
        new Chart(pengeluaranCtx, { type: 'line', data: formatChartData(pengeluaranData, 'Pengeluaran'), options: commonOptions });

        // Pemasukan Chart
        const pemasukanCtx = document.getElementById('pemasukanChart').getContext('2d');
        new Chart(pemasukanCtx, { type: 'line', data: formatChartData(pemasukanData, 'Pemasukan'), options: commonOptions });
    </script>
</body>

</html>