<?php
// Nama File : data_transaksi.php
// Deskripsi : File ini untuk menampilkan mengatur transaksi yang telah dilakukan oleh pelanggan
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November 2024 - 29 Desember 2024

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
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
            
        <!-- Kontent-->
        <div class="container mt-4">
                <h3><i class="fas fa-users me-2"></i> Data Transaksi</h3>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">INVOICE</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM transaksi");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($query)) {
                            // Tentukan warna berdasarkan status
                            $statusColor = '';
                            if ($data['status'] == 'Selesai') {
                                $statusColor = 'bg-success text-white'; // Hijau untuk selesai
                            } elseif ($data['status'] == 'Pending') {
                                $statusColor = 'bg-warning text-dark'; // Kuning untuk pending
                            } elseif ($data['status'] == 'Batal') {
                                $statusColor = 'bg-danger text-white'; // Merah untuk batal
                            }
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['invoice']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo "Rp " . number_format($data['total'], 0, ',', '.'); ?></td>
                                <td><span class="badge <?php echo $statusColor; ?>"><?php echo $data['status']; ?></span></td>
                                <td>
                                    <button 
                                        class="btn btn-warning btn-edit" 
                                        data-invoice="<?php echo $data['invoice']; ?>" 
                                        data-status="<?php echo $data['status']; ?>">
                                        <i class="fas fa-edit"></i> Edit Status
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Edit Status -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="update_transaksi.php">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Status Transaksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="editInvoice" class="form-label">Invoice</label>
                                <input type="text" class="form-control" id="editInvoice" name="invoice" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select class="form-control" id="editStatus" name="status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Batal">Batal</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editButtons = document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                const invoice = this.getAttribute('data-invoice');
                const status = this.getAttribute('data-status');
                document.getElementById('editInvoice').value = invoice;
                document.getElementById('editStatus').value = status;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });        
    </script>
    </body>
</html>