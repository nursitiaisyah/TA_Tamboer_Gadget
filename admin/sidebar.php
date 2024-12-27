<!-- sidebar.php -->
<aside id="sidebar" class="js-sidebar">
    <div class="h-100">
        <div class="sidebar-logo d-flex align-items-center">
            <img src="../image/logol1.png" alt="Logo" style="width: 50px; height: auto; margin-right: 5px;">
            <!-- Ubah margin-right di sini -->
            <a href="#" class="text-decoration-none">TAMBOER GADGET</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="halaman_admin.php" class="sidebar-link">
                    <i class="fa-solid fa-house pe-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="sidebar-item">
                <a href="produk.php" class="sidebar-link">
                    <i class="fa-solid fa-box-open pe-2"></i>
                    Produk
                </a>
            </li>
            <li class="sidebar-item">
                <a href="varian.php" class="sidebar-link">
                    <i class="fa-solid fa-layer-group pe-2"></i>
                    Varian
                </a>
            </li>
            <li class="sidebar-item">
                <a href="penjualan.php" class="sidebar-link">
                    <i class="fa-solid fa-cash-register pe-2"></i>
                    Penjualan
                </a>
            </li>
            <li class="sidebar-item">
                <a href="pemasukan.php" class="sidebar-link">
                    <i class="fa-solid fa-money-bill-wave pe-2"></i>
                    Pemasukan
                </a>
            </li>
            <li class="sidebar-item">
                <a href="pengeluaran.php" class="sidebar-link">
                    <i class="fa-solid fa-wallet pe-2"></i>
                    Pengeluaran
                </a>
            </li>
            <!-- 
            <li class="sidebar-item">
                <a href="akun.php" class="sidebar-link">
                    <i class="fa-solid fa-user pe-2"></i>
                    Akun
                </a>
            </li>
             -->
            <li class="sidebar-item">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                    aria-expanded="false"><i class="fa-solid fa-file-alt pe-2"></i>
                    Laporan
                </a>
                <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="laporan_penjualan.php" class="sidebar-link">
                            <i class="fa-solid fa-file-invoice-dollar pe-2"></i>
                            Laporan Penjualan
                        </a>
                    </li>
                    <!-- <li class="sidebar-item">
                        <a href="laporan_pemasukan.php" class="sidebar-link">
                            <i class="fa-solid fa-coins pe-2"></i>
                            Laporan Pemasukan
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="laporan_pengeluaran.php" class="sidebar-link">
                            <i class="fa-solid fa-wallet pe-2"></i>
                            Laporan Pengeluaran
                        </a>
                    </li>-->
                    <li class="sidebar-item">
                        <a href="laporan_keuangan.php" class="sidebar-link">
                            <i class="fa-solid fa-calendar-alt pe-2"></i>
                            Laporan Keuangan
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>