<?php
// Nama File : [search.php]
// Deskripsi : [File ini sebagai proses dan menampilkan hasil pencarian kamar sesuai dengan tipe, fasilitas, atau harga]
// Dibuat Oleh : [Muhammad Farrel Fahrezi] NIM [3312401061] & [Rafi Akhbar Dirgahayuri] NIM [3312401065]
// Tanggal Dibuat : 19 Desember 2024 - 28 Desember 2024

include 'koneksi.php';

// Inisialisasi variabel pencarian
$searchQuery = '';

// Memeriksa apakah parameter query dikirim melalui metode GET
if (isset($_GET['query'])) {
    $searchQuery = mysqli_real_escape_string($koneksi, $_GET['query']);
}

// Query untuk mencari kamar berdasarkan tipe, fasilitas, atau harga
$query = "SELECT * FROM kamar WHERE id LIKE '%$searchQuery%' OR tipe LIKE '%$searchQuery%' OR fasilitas LIKE '%$searchQuery%' OR harga LIKE '%$searchQuery%'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - RestEasy Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('hotelbg.jpeg');
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            z-index: 1;
        }
        .container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 1100px;
        }
        .room-card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .room-card img {
            width: 100%;
            border-radius: 8px;
        }
        .room-card h5 {
            margin-top: 10px;
            font-size: 1.2rem;
            color: #007bff;
        }
        .room-card p {
            color: #333;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .search-bar {
            position: relative;
            margin-bottom: 20px;
        }
        .search-bar input {
            width: 100%;
            padding: 10px;
            border-radius: 25px;
            border: 1px solid #ccc;
        }
        h2, h5 {
            color: #333;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-group .btn {
            width: 48%;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container my-5">
        <h2>Hasil Pencarian untuk "<?php echo htmlspecialchars($searchQuery); ?>"</h2>
        <div class="search-bar">
            <!-- Form untuk pencarian ulang -->
            <form method="GET" action="">
                <input type="text" name="query" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Cari lagi..." required>
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="dashboard2.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                </div>
            </form>
        </div>
        <div class="row">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <!-- Jika hasil ditemukan, tampilkan daftar kamar -->
                <?php while ($room = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4">
                        <div class="room-card">
                            <a href="daftar_standart.php">
                                <img src="images/<?php echo htmlspecialchars($room['gambar']); ?>" alt="<?php echo htmlspecialchars($room['tipe']); ?>">
                            </a>
                            <h5><?php echo htmlspecialchars($room['tipe']); ?> - <?php echo htmlspecialchars($room['id']); ?></h5>
                            <p>Rp. <?php echo number_format($room['harga'], 0, ',', '.'); ?>/malam</p>
                            <a href="Formulir_Pemesanan.php" class="btn btn-primary">Pesan Sekarang</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Jika tidak ada hasil ditemukan -->
                <p>Tidak ada hasil yang ditemukan untuk pencarian Anda.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal untuk input pencarian -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="GET" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Cari Lagi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="query">Kata Kunci</label>
                            <input type="text" class="form-control" id="query" name="query" value="<?php echo htmlspecialchars($searchQuery); ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
