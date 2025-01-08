<?php
// Nama File : login.php
// Deskripsi : File ini sebagai proses sekaligus formulir untuk melakukan login
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November - 29 Desember 2024

/*
Pseudocode:
1. Mulai
2. Inisialisasi:
    - Mulai sesi dengan session_start()
    - Sertakan koneksi ke database dengan include 'koneksi.php'
    - Tentukan variabel $error sebagai string kosong untuk menyimpan pesan error

3. Proses Formulir Login:
    - Jika metode request adalah POST:
        - Ambil nilai email dan password dari form input
        - Amankan nilai email dengan mysqli_real_escape_string() untuk mencegah SQL injection

4. Query Database:
    - Lakukan query untuk mencari pengguna berdasarkan email yang dimasukkan
    - Jika query gagal, tampilkan error dan hentikan eksekusi
    - Jika query berhasil, periksa apakah ada hasil yang ditemukan

5. Verifikasi Email dan Password:
    - Jika email ditemukan dalam database:
        - Ambil data pengguna dari hasil query
        - Verifikasi password yang dimasukkan dengan password_verify()
        - Jika password benar:
            - Simpan email dan role pengguna ke dalam session ($_SESSION['email'], $_SESSION['role'])
            - Arahkan pengguna ke halaman dashboard yang sesuai dengan role (admin atau pelanggan)
            - Hentikan eksekusi
        - Jika password salah, tampilkan pesan error "Password Anda salah!"
    
6. Tampilan Pesan Error:
    - Jika email tidak ditemukan di database, tampilkan pesan error "Email tidak ditemukan!"

7. Akhiri
*/

session_start();
include 'koneksi.php';

$error = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input dari form
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Escape input untuk mencegah SQL Injection
    $email = mysqli_real_escape_string($koneksi, $email);

    // Query untuk mendapatkan data berdasarkan email
    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");

    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    // Periksa apakah email ditemukan
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        // Verifikasi password
        if (password_verify($pass, $row['password'])) {
            $_SESSION['email'] = $row['email']; // Simpan email ke session
            $_SESSION['role'] = $row['role']; // Simpan role ke session

            // Arahkan berdasarkan role
            if ($row['role'] == 'admin') {
                header("Location: admin.php"); // Redirect ke halaman dashboard admin
            } elseif ($row['role'] == 'pelanggan') {
                header("Location: dashboard2.php"); // Redirect ke halaman dashboard pelanggan
            }
            exit();
        } else {
            $error = "Password Anda salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestEasy</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
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
            filter: blur(8px);
            z-index: 1;
        }

        .login-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        .login-container h2 {
            margin-bottom: 10px;
        }

        .login-container .form-group {
            margin-bottom: 20px;
        }

        .login-container button {
            width: 100%;
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 576px) {
            body {
                padding-top: 10vh;  /* Berikan sedikit ruang di atas agar form tidak terlalu turun */
            }

            .login-container {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

<div class="background"></div>
<div class="login-container">
    <h2 class="text-center">RestEasy</h2>
    <h5 class="text-center">Welcome to RestEasy</h5>

    <!-- Tampilkan pesan error jika ada -->
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
        <div class="text-center mt-3">
            <a href="reset_password.php" class="text-muted">Forgot Password?</a>
        </div>
        <div class="text-center mt-2">
            <p>Don't have an account? <a href="register.php" class="text-primary">Register here</a></p>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
