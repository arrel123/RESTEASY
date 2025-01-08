
<?php
// Nama File    : resteasy.php
// Deskripsi    : File ini adalah landing page yang memungkinkan pelanggan menjelajahi informasi tentang hotel sebelum login.
// Dibuat Oleh  : Muhammad Farrel Fahrezi (NIM: 3312401061) & Muhammad Naufal Hakim (NIM: 3312401088)
// Tanggal Dibuat : - 29 Desember 2024
  include 'koneksi.php';
?>

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
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="login.php">Book Now</a></li>
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
            <!-- Kamar Standar -->
            <div class="col-md-4">
                <div class="room-card">
                    <a href="daftar_standart.php">
                        <img src="bg2.1.jpg" alt="Standard Room">
                    </a>
                        <h5>Standart Room</h5>
                        <p>Rp. 500.000 - 1.000.000/malam</p>
                </div>
            </div>
            <!-- Kamar Deluxe -->
            <div class="col-md-4">
                <div class="room-card">
                    <a href="daftar_deluxe.php">
                        <img src="bg2.2.jpg" alt="Deluxe Room">
                    </a>
                        <h5>Deluxe Room</h5>
                        <p>Rp. 1.750.000/malam</p>
                </div>
            </div>
            <!-- Kamar Suite -->
            <div class="col-md-4">
                <div class="room-card">
                    <a href="daftar_suite.php">
                        <img src="bg2.3.jpg" alt="Suite Room">
                    </a>
                    <h5>Suite Room</h5>
                    <p>Rp. 2.050.000/malam</p>
                </div>
            </div>
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
