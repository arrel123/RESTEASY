<?php
// Nama File : pemesanan.php
// Deskripsi : File ini menampilkan data pelanggan yang mengisi formulir pemesanan
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 20 Desember - 29 Desember 2024
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e7decf;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #706c8a;
        }
        .sidebar {
            height: 100vh;
            background-color: #dbdbd5;
            color: black;
        }
        .sidebar a {
            color: black;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #e7decf;
            padding: 10px;
            margin: auto;
        }
        .card {
            margin-top: 20px;
        }
        .menu-btn {
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
        .offcanvas {
            width: 250px;
        }
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
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
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

    <!-- Konten utama -->
        <div class="container mt-4">
            <h3><i class="fas fa-users me-2"></i> Data Transaksi</h3>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">NAMA LENGKAP</th>
                            <th scope="col">NO TELEPON</th>
                            <th scope="col">CHECK-IN</th>
                            <th scope="col">CHECK-OUT</th>
                            <th scope="col">TAMU DEWASA</th>
                            <th scope="col">TAMU ANAK-ANAK</th>
                            <th scope="col">KODE KAMAR</th>
                            <th scope="col">PERMINTAAN KHUSUS</th>
                            <th scope="col">TANGGAL PEMESANAN</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mengambil data pemesanan dari tabel database pemesanan
                        include 'koneksi.php';
                        $query = mysqli_query($koneksi, "SELECT * FROM pemesanan");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['name']; ?></td>
                                <td><?php echo $data['phone']; ?></td>
                                <td><?php echo $data['check_in']; ?></td>
                                <td><?php echo $data['check_out']; ?></td>
                                <td><?php echo $data['adults']; ?></td>
                                <td><?php echo $data['children']; ?></td>
                                <td><?php echo $data['room_id']; ?></td>
                                <td><?php echo $data['request']; ?></td>
                                <td><?php echo $data['created_at']; ?></td>
                                <td>
                                    <a href="hapus_pemesanan.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pemesanan ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
             </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>