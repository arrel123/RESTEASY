<?php
// File: admin.php
// Deskripsi: Halaman dashboard untuk admin setelah login
// Dibuat Oleh: Windy Yohana Gurning (NIM: 3312401066) 
// Tanggal Dibuat: 18 November 2024 - 29 Desember 2024

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Query untuk mendapatkan jumlah data terkait
$queryKamar = "SELECT COUNT(*) as totalKamar FROM kamar"; 
$queryCustomer = "SELECT COUNT(*) as totalCustomer FROM users WHERE role = 'pelanggan'"; 
$queryTransaksi = "SELECT COUNT(*) as totalTransaksi FROM transaksi"; 

// Eksekusi query dan menyimpan hasilnya sebagai variabel
$hasilKamar = mysqli_fetch_assoc(mysqli_query($koneksi, $queryKamar));
$hasilCustomer = mysqli_fetch_assoc(mysqli_query($koneksi, $queryCustomer));
$hasilTransaksi = mysqli_fetch_assoc(mysqli_query($koneksi, $queryTransaksi));

// Menyimpan jumlah hasil query ke dalam variabel
$totalKamar = $hasilKamar['totalKamar'];
$totalCustomer = $hasilCustomer['totalCustomer'];
$totalTransaksi = $hasilTransaksi['totalTransaksi'];

// Jumlah kategori kamar dianggap tetap (berdasarkan kebutuhan aplikasi)
$total_kategori = 3;

// Menutup koneksi ke database
$koneksi->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e7decf;
        }
        .navbar {
            background-color: #706c8a;
        }
        .sidebar {
            height: 100vh;
            background-color: #dbdbd5;
            color: black;
        }
        .sidebar a:hover {
            background-color: #e7decf;
            padding: 10px;
            margin: auto;
        }
        .card {
            margin-top: 20px;
        }
        .footer {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        /* Media Query untuk tampilan mobile */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .sidebar-mobile {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                width: 250px;
                background-color: #dbdbd5;
                z-index: 1050;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar-mobile.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">DASHBOARD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMobile" aria-controls="sidebarMobile">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown d-none d-lg-block">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar -->
        <div class="d-flex">
            <!-- Sidebar Desktop -->
            <div class="sidebar p-3 d-none d-lg-block">
                <h4>Menu</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-black" href="admin.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="data_kamar.php"><i class="fas fa-bed me-2"></i>Data Kamar</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="data_customer.php"><i class="fas fa-users me-2"></i>Data Customer</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="pemesanan.php"><i class="fas fa-credit-card me-2"></i>Pemesanan</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="data_transaksi.php"><i class="fas fa-file-invoice-dollar me-2"></i>Riwayat Transaksi</a>
                        <hr class="bg-secondary">
                    </li>
                </ul>
            </div>

        <!-- Sidebar Mobile -->
        <div class="offcanvas offcanvas-start sidebar-mobile" id="sidebarMobile">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-black" href="admin.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="data_kamar.php"><i class="fas fa-bed me-2"></i>Data Kamar</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="data_customer.php"><i class="fas fa-users me-2"></i>Data Customer</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="pemesanan.php"><i class="fas fa-credit-card me-2"></i>Pemesanan</a>
                        <hr class="bg-secondary">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="data_transaksi.php"><i class="fas fa-file-invoice-dollar me-2"></i>Riwayat Transaksi</a>
                        <hr class="bg-secondary">
                    </li>
                </ul>
                <a class="btn btn-danger w-100 mt-3" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a>
            </div>
        </div>

        <!-- Konten -->
        <div class="col-lg-10 col-md-12 p-5 pt-2">
            <h3><i class="fas fa-tachometer-alt me-2"></i> Dashboard</h3>
            <hr>
            <div class="row text-white">
                <div class="col-lg-3 col-sm-6">
                    <div class="card border-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-bed"></i> Jumlah Kamar</h5>
                            <p class="card-text">Total: <?php echo $totalKamar; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card border-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-bed"></i> Kategori Kamar</h5>
                            <p class="card-text">Total: <?php echo $total_kategori; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card border-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-users me-2"></i> Jumlah Customer</h5>
                            <p class="card-text">Total: <?php echo $totalCustomer; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card border-danger mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-solid fa-money-bill"></i> Transaksi</h5>
                            <p class="card-text">Total: <?php echo $totalTransaksi; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>