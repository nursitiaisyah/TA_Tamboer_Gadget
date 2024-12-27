<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_penjualan = $_GET['id'];

    // Query untuk mengambil data penjualan berdasarkan ID
    $sql = "SELECT 
            f.kode_penjualan, 
            p.tanggal, 
            p.nama_pembeli, 
            p.no_hp, 
            p.jumlah, 
            p.total_harga, 
            p.metode_pembayaran, 
            u.nama AS nama_kasir, 
            prod.nama_hp, 
            v.ram, 
            v.warna, 
            v.penyimpanan, 
            v.harga_jual
        FROM penjualan p
        JOIN varian v ON p.id_varian = v.id_varian
        JOIN produk prod ON v.id_produk = prod.id_produk
        JOIN users u ON p.id_user = u.id_user
        JOIN faktur_penjualan f ON p.id_faktur = f.id_faktur
        WHERE p.id_penjualan = $id_penjualan";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID penjualan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Penjualan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .faktur-container {
            width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .header h5 {
            margin: 0;
            font-size: 18px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info .row div {
            font-size: 14px;
        }

        .table thead th {
            font-size: 14px;
            text-align: center;
        }

        .table tbody td {
            font-size: 14px;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
        }

        .footer .row div {
            font-size: 14px;
        }

        .terbilang {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="faktur-container">
        <div class="header">
            <h5>TAMBOER GADGET</h5>
            <p>Jl. Indragiri No. 155, Sumberejo, Kota Batu</p>
            <p>Telp: 0812-3056-5641</p>
        </div>

        <div class="info">
            <div class="row">
                <div class="col-6">
                    <p><strong>Nomor Faktur:</strong> <?= $row['kode_penjualan']; ?></p>
                    <p><strong>Nama Pembeli:</strong> <?= $row['nama_pembeli']; ?></p>
                    <p><strong>No. HP:</strong> <?= $row['no_hp']; ?></p>
                </div>
                <div class="col-6 text-end">
                    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($row['tanggal'])); ?></p>
                    <p><strong>Kasir:</strong> <?= $row['nama_kasir']; ?></p>
                </div>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Item</th>
                    <th>Spesifikasi</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><?= $row['nama_hp']; ?></td>
                    <td><?= $row['ram']; ?> RAM, <?= $row['penyimpanan']; ?>, <?= $row['warna']; ?></td>
                    <td><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                    <td><?= $row['jumlah']; ?></td>
                    <td><?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <div class="row">
                <div class="col-6">
                    <p><strong>Keterangan:</strong></p>
                    <p>Terima kasih telah berbelanja di Tamboer Gadget!</p>
                </div>
                <div class="col-6 text-end">
                    <p><strong>Total Akhir:</strong> <?= number_format($row['total_harga'], 0, ',', '.'); ?></p>
                    <p><strong>Metode Pembayaran:</strong> <?= $row['metode_pembayaran']; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>