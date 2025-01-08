<?php
// Nama File : daftar_deluxe.php
// Deskripsi : File ini untuk menampilkan list kamar sesuai dengan tipe [Deluxe]
// Dibuat Oleh : Melanie Putri (NIM: 3312401075) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 17 Desember 2024 - 30 Desember 2024

include 'koneksi.php';

// Query untuk mengambil data kamar dengan tipe 'deluxe'
$query = mysqli_query($koneksi, "SELECT * FROM kamar WHERE tipe = 'deluxe' AND tersedia = 1");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestEasy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="styledkamar.css" rel="stylesheet"/>
</head>
<body>
    <!-- Navbar -->
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Layout -->
    <div class="layout">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>Standart Room</h2>
            <a href="daftar_standart.php">
                <img alt="Standart Room" src="bg2.1.jpg" />
            </a>
            <h2>Deluxe Room</h2>
            <a href="daftar_deluxe.php">
                <img alt="Deluxe Room" src="bg2.2.jpg" />
            </a>
            <h2>Suite Room</h2>
            <a href="daftar_suite.php">
                <img alt="Suite Room" src="bg2.3.jpg" />
            </a>
        </div>

        <!-- Content -->
        <div class="content">
            <?php while ($data = mysqli_fetch_assoc($query)) { ?>
            <div class="room-card">
                <!-- Gambar Kamar -->
                <img alt="<?php echo htmlspecialchars($data['tipe']); ?>" src="images/<?php echo htmlspecialchars($data['gambar']); ?>"/>
                <!-- Informasi Kamar -->
                <div class="room-info">
                    <h3><?php echo htmlspecialchars($data['tipe']); ?> Room - <?php echo htmlspecialchars($data['id']); ?></h3>
                    <ul>
                        <li><?php echo htmlspecialchars($data['kasur']); ?> Bed</li>
                        <?php 
                        // Fungsi explode untuk memecah data fasilitas menjadi list berdasarkan tanda koma
                        $fasilitasArray = explode(',', $data['fasilitas']);
                        foreach ($fasilitasArray as $fasilitas) {
                            echo '<li>' . htmlspecialchars(trim($fasilitas)) . '</li>';
                        }
                        ?>
                    </ul>
                </div>
                <!-- Harga Kamar -->
                <div class="room-price">
                    <h4>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></h4>
                    <a href="Formulir_Pemesanan.php"><button>Book Now</button></a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
