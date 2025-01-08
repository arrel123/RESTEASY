<?php
// Nama File : dashboard2.php
// Deskripsi : File ini untuk menampilkan dashboard setelah pelanggan berhasil melakukan login
// Dibuat Oleh : Muhammad Farrel Fahrezi (NIM: 3312401061) & Muhammad Naufal Hakim (NIM : 3312401088)
// Tanggal Dibuat : - 29 Desember 2024

   session_start();
   if (!isset($_SESSION['email'])) {
      header("Location: login.php");
      exit();
   }

   include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>RestEasy Hotel</title>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="styledashboard.css" rel="stylesheet">
   </head>
   <body>

      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-transparan">
         <div class="container">
            <a class="navbar-brand" href="#">
            <img src="logo_resteasy.jpg" alt="RestEasy Logo" class="rounded-circle">RestEasy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                  <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                     <i class="fas fa-user-circle"></i> 
                     </a> 
                     <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="edit.php">Edit Profil</a></li>
                        <li>
                           <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                     </ul>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

         <!-- Hero Section -->
      <div class="hero-section">
         <div class="background-image"></div>
         <div class="hero-text">
            <h1>Start your vacation with us</h1>
            <p>Discover the world with RestEasy Hotel. Get the best service with us.</p>
         </div>
         <div class="search-bar d-flex justify-content-between align-items-center">
            <form action="search.php" method="GET" class="d-flex">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="query" class="form-control" placeholder="Search room" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
         </div>
      </div>

      <!-- Room Section -->
      <div class="container my-5">
         <h2 id="home" class="section-heading">OUR ROOMS</h2>
         <div class="row">
            <!-- Standard Room -->
            <div class="col-md-4">
               <div class="room-card">
                  <a href="daftar_standart.php">
                  <img src="bg2.1.jpg" alt="Standard Room">
                  </a>
                  <h5>Standart Room</h5>
                  <p>Rp. 250.000 - 1.000.000/malam</p>
               </div>
            </div>
            <!-- Deluxe Room -->
            <div class="col-md-4">
               <div class="room-card">
                  <a href="daftar_deluxe.php">
                  <img src="bg2.2.jpg" alt="Deluxe Room">
                  </a>
                  <h5>Deluxe Room</h5>
                  <p>Rp. 1.000.000 - 1.500.000/malam</p>
               </div>
            </div>
            <!-- Suite Room -->
            <div class="col-md-4">
               <div class="room-card">
                  <a href="daftar_suite.php">
                  <img src="bg2.3.jpg" alt="Suite Room">
                  </a>
                  <h5>Suite Room</h5>
                  <p>Rp. 1.500.000 + /malam</p>
               </div>
            </div>
         </div>
      </div>

      <!-- Rekomendasi Kamar -->
      <div class="bg-danger text-white text-center py-2">
         <h5>Rekomendasi Spesial</h5>
      </div>
      <?php
      // Query untuk mengambil data kamar dengan nilai rekomendasi = '1'
      $query = mysqli_query($koneksi, "SELECT * FROM kamar WHERE rekomendasi = 1 AND tersedia = 1"); ?>
      <div class="container">
         <div class="row g-4">
            <?php
            // Perulangan untuk menampilkan semua data kamar rekomendasi
            while ($room = mysqli_fetch_assoc($query)) : ?>
                  <div class="col-12 mb-4">
                     <div class="room-card card h-100 text-light overflow-hidden">
                        <div class="row g-0">
                              <div class="col-md-4">
                                 <img src="images/<?php echo htmlspecialchars($room['gambar']); ?>" class="room-image w-100" alt="<?php echo htmlspecialchars($room['tipe']); ?>">
                              </div>
                              <div class="col-md-8">
                                 <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                          <h4 class="card-title mb-0"><?php echo htmlspecialchars($room['id']); ?></h4>
                                          <h6 class="card-title mb-0">(<?php echo htmlspecialchars($room['tipe']); ?>)</h6>
                                          <div class="price-tag">
                                             Rp. <?php echo number_format($room['harga'], 0, ',', '.'); ?>/malam
                                          </div>
                                    </div>
                                    <p class="mb-3">
                                          <i class="fas fa-bed me-2"></i>
                                          <?php echo htmlspecialchars($room['kasur']); ?>
                                    </p>
                                    <h6 class="mb-3">Facilities:</h6>
                                    <ul class="facilities-list mb-4">
                                          <?php
                                          $facilities = explode(',', $room['fasilitas']);
                                          foreach ($facilities as $facility) :
                                          ?>
                                             <li><?php echo htmlspecialchars(trim($facility)); ?></li>
                                          <?php endforeach; ?>
                                    </ul>
                                    <div class="text-end">
                                          <a href="Formulir_Pemesanan.php" class="btn book-now-btn">
                                             <i class="fas fa-calendar-check me-2"></i> Pesan Sekarang
                                          </a>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     </div>
                  </div>
            <?php endwhile; ?>
            <!-- Pesan jika tidak ada data -->
            <?php if (mysqli_num_rows($query) === 0) : ?>
                  <p class="text-white text-center">No recommended rooms available.</p>
            <?php endif; ?>
         </div>
      </div>

       <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h4 id="about">About Us</h4>
                <p>Experience the Extraordinary at RestEasy Hotel  
                  RestEasy Hotel brings comfort with a touch of elegance. Located in the city center, we offer modern rooms, 
                  a classy restaurant, a spacious swimming pool, and a comfortable sports area for visitors. Whether you come for business or pleasure, 
                  we are ready to provide an unforgettable experience.</p>
            </div>
            <div class="footer-section">
                <h4 id="contact">Contact Us</h4>
                <ul>
                    <li>📍 Hotel RestEasy, Batam</li>
                    <li>📞 +62 852 7190 1194</li>
                    <li>✉️ info@resteasyhotel.com</li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="https://wa.me/qr/FLMEQFAAKLWVB1">Contact Us</a></li>
                    <li><a href="https://maps.app.goo.gl/AcL35RGv97HTroc26">Locations</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="https://www.instagram.com/arrelzi?igsh=MmltcHVqeHJuMHhv"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Paradise Hotel. All Rights Reserved.</p>
        </div>
    </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   </body>
</html>