<?php
// Nama File : Formulir_Pemesanan.php
// Deskripsi : File ini digunakan untuk mengirim data pemesanan dari pelanggan kepada admin
// Dibuat Oleh : Saskia Ananda Irawan (NIM: 3312401070) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November - 29 Desember 2024
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Ambil data kamar dari tabel kamar
$query = mysqli_query($koneksi, "SELECT * FROM kamar WHERE tersedia = 1");

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styleform.css">  
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000080;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo_resteasy.jpg" alt="Logo" width="50" height="50" class="rounded-circle">
                RestEasy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard2.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard2.php#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="dashboard2.php#contact">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="edit.php">Edit Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1>Formulir Pemesanan</h1>
        <form action="buat_invoice.php" method="POST">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" placeholder="Nomor Telepon" required>
            </div>
            <div class="form-group">
                <label for="checkin">Tanggal Check-In</label>
                <input type="date" id="checkin" name="checkin" required>
            </div>
            <div class="form-group">
                <label for="checkout">Tanggal Check-Out</label>
                <input type="date" id="checkout" name="checkout" required>
            </div>
            <div class="form-group">
                <label>Jumlah Tamu Dewasa</label>
                <input type="number" name="adults" value="0" min="0" required>
            </div>
            <div class="form-group">
                <label>Jumlah Tamu Anak-anak</label>
                <input type="number" name="children" value="0" min="0" required>
            </div>
            <div class="form-group">
                <label for="room-type">Tipe Kamar</label>
                <select name="room-type" id="room-type" required>
                    <option value="" disabled selected>Pilih Tipe Kamar</option>
                    <?php while ($data = mysqli_fetch_assoc($query)) { ?>
                        <option value="<?php echo $data['id']; ?>">
                            <?php echo $data['id']; ?> - <?php echo $data['tipe']; ?> (Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="request">Permintaan Khusus</label>
                <textarea id="request" name="request" rows="4" placeholder="Masukkan permintaan khusus Anda..."></textarea>
            </div>
            <button type="submit" class="submit-btn">Pesan Sekarang</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
