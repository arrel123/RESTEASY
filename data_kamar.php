<?php
// Nama File : data_kamar.php
// Deskripsi : File ini untuk menampilkan dan mengatur data kamar yang disediakan hotel kami
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November 2024 - 29 Desember 2024

session_start(); 
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
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

        <!-- Content Area -->
        <main class="col-md-9 col-12 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3><i class="fas fa-bed me-2"></i>Data Kamar</h3>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus me-2"></i>Tambah Kamar
                </button>
            </div>
            <hr>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Tipe</th>
                            <th>Kasur</th>
                            <th>Fasilitas</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Tersedia</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'koneksi.php';
                    // Query untuk mengambil data kamar dari tabel database kamar
                    $query = mysqli_query($koneksi, "SELECT * FROM kamar");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                        // Tentukan warna untuk ID berdasarkan rekomendasi
                        $idColor = ($data['rekomendasi'] == 1) ? 'bg-success' : 'bg-warning';
                         // Tentukan status Tersedia
                        $tersedia = $data['tersedia'] == 1 ? 'Tersedia' : 'Tidak Tersedia';
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td> 
                            <td class="<?php echo $idColor; ?>"><?php echo $data['id']; ?></td>
                            <td><?php echo $data['tipe']; ?></td>
                            <td><?php echo $data['kasur']; ?></td>
                            <td><?php echo $data['fasilitas']; ?></td>
                            <td><?php echo "Rp " . number_format($data['harga'], 0, ',', '.'); ?></td>
                            <td><img src="images/<?php echo $data['gambar']; ?>" alt="<?php echo $data['tipe']; ?>" style="width: 100px;"></td>
                            <td><?php echo $tersedia; ?></td>
                            <td>
                                <button 
                                    class="btn btn-warning btn-edit" 
                                    data-id="<?php echo $data['id']; ?>" 
                                    data-tipe="<?php echo $data['tipe']; ?>" 
                                    data-kasur="<?php echo $data['kasur']; ?>" 
                                    data-fasilitas="<?php echo $data['fasilitas']; ?>" 
                                    data-harga="<?php echo $data['harga']; ?>" 
                                    data-gambar="<?php echo $data['gambar']; ?>"
                                    data-rekomendasi="<?php echo $data['rekomendasi']; ?>"
                                    data-tersedia="<?php echo $data['tersedia']; ?>">
                                    <i class="fas fa-edit"></i>Edit
                                </button>
                                <a href="hapus_kamar.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kamar ini?')">
                                    <i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

    <!-- Modal Tambah Data Kamar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addModalLabel">Tambah Data Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAdd" method="POST" enctype="multipart/form-data" action="tambah_kamar.php">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="addId" class="form-label">ID Kamar</label>
                                <input type="text" class="form-control" id="addId" name="id" required>
                            </div>
                            <div class="col-md-6">
                                <label for="addTipe" class="form-label">Tipe Kamar</label>
                                <select class="form-select" id="addTipe" name="tipe" required>
                                    <option value="Standard">Standard</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="addKasur" class="form-label">Kasur</label>
                                <select class="form-select" id="addKasur" name="kasur" required>
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                    <option value="Twin">Twin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="addFasilitas" class="form-label">Fasilitas</label>
                                <textarea class="form-control" id="addFasilitas" name="fasilitas" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="addHarga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="addHarga" name="harga" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="addGambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="addGambar" name="gambar" accept="image/*" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data Kamar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Kamar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEdit" method="POST" enctype="multipart/form-data" action="update_kamar.php">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editTipe" class="form-label">Tipe Kamar</label>
                                <select class="form-select" id="editTipe" name="tipe" required>
                                    <option value="Standard">Standard</option>
                                    <option value="Deluxe">Deluxe</option>
                                    <option value="Suite">Suite</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editKasur" class="form-label">Kasur</label>
                                <select class="form-select" id="editKasur" name="kasur" required>
                                    <option value="Single">Single</option>
                                    <option value="Double">Double</option>
                                    <option value="Twin">Twin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editFasilitas" class="form-label">Fasilitas</label>
                                <textarea class="form-control" id="editFasilitas" name="fasilitas" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="editHarga" class="form-label">Harga</label>
                                <input type="number" class="form-control" id="editHarga" name="harga" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editGambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="editGambar" name="gambar" accept="image/*">
                                <img id="editGambarPreview" src="" alt="Current Image" style="width: 100px; margin-top: 10px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editRekomendasi" class="form-label">Rekomendasi</label>
                                <select class="form-select" id="editRekomendasi" name="rekomendasi" required>
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editTersedia" class="form-label">Tersedia</label>
                                <select class="form-select" id="editTersedia" name="tersedia" required>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Tidak Tersedia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const editButtons = document.querySelectorAll('.btn-edit');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('editModal'));
                const id = this.getAttribute('data-id');
                const tipe = this.getAttribute('data-tipe');
                const kasur = this.getAttribute('data-kasur');
                const fasilitas = this.getAttribute('data-fasilitas');
                const harga = this.getAttribute('data-harga');
                const gambar = this.getAttribute('data-gambar');
                const rekomendasi = this.getAttribute('data-rekomendasi');
                const tersedia = this.getAttribute('data-tersedia');

                document.getElementById('editId').value = id;
                document.getElementById('editTipe').value = tipe;
                document.getElementById('editKasur').value = kasur;
                document.getElementById('editFasilitas').value = fasilitas;
                document.getElementById('editHarga').value = harga;
                document.getElementById('editGambarPreview').src = 'images/' + gambar;
                document.getElementById('editRekomendasi').value = rekomendasi;
                document.getElementById('editTersedia').value = tersedia;
                new bootstrap.Modal(document.getElementById('editModal')).show();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>