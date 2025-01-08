<?php
// Nama File : register.php
// Deskripsi : File ini sebagai proses sekaligus formulir untuk mendaftarkan akun pengguna (Pelanggan)
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November 2024 - 29 Desember 2024

/*
Pseudocode:

1. Mulai
2. Jika metode request adalah POST (form dikirim):
    2.1 Ambil inputan pengguna dari form (email, nomor, password, confirmPassword)
    2.2 Validasi input:
        2.2.1 Jika ada field kosong, tampilkan pesan error "Semua field wajib diisi!"
        2.2.2 Jika email tidak valid, tampilkan pesan error "Email tidak valid!"
        2.2.3 Jika nomor telepon tidak valid (bukan angka atau panjangnya tidak sesuai), tampilkan pesan error "Nomor telepon tidak valid!"
        2.2.4 Jika password dan konfirmasi password tidak cocok, tampilkan pesan error "Password dan konfirmasi password tidak cocok!"
    2.3 Cek jika email atau nomor sudah terdaftar di database:
        2.3.1 Jika email atau nomor terdaftar, tampilkan pesan error yang sesuai (misalnya, "Email sudah terdaftar!" atau "Nomor HP sudah terdaftar!")
    2.4 Jika semua validasi berhasil, lakukan hashing pada password
    2.5 Simpan data pengguna baru ke database
    2.6 Jika registrasi berhasil, tampilkan pesan sukses dan arahkan pengguna ke halaman login
    2.7 Jika registrasi gagal, tampilkan pesan error
3. Akhiri
*/

include 'koneksi.php'; 

// Mengecek jika form dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']); 
    $nomor = trim($_POST['nomor']); 
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    // Validasi input
    if (empty($email) || empty($nomor) || empty($password) || empty($confirmPassword)) {
        $message = 'Semua field wajib diisi!'; // Pesan jika ada field yang kosong
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validasi format email
        $message = 'Email tidak valid!';
    } elseif (!is_numeric($nomor) || strlen($nomor) < 10 || strlen($nomor) > 15) { // Validasi nomor telepon
        $message = 'Nomor telepon harus berupa angka dan memiliki panjang antara 10-15 karakter!';
    } elseif ($password !== $confirmPassword) { // Validasi jika password dan konfirmasi password tidak cocok
        $message = 'Password dan konfirmasi password tidak cocok!';
    } else {
        // Mengecek apakah email atau nomor HP sudah terdaftar di database
        $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' OR nomor='$nomor'");
        if (mysqli_num_rows($result) > 0) {
            // Mendapatkan data dari database untuk menentukan pesan error yang tepat
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email) {
                $message = 'Email sudah terdaftar!';
            } elseif ($row['nomor'] === $nomor) {
                $message = 'Nomor HP sudah terdaftar!';
            }
        } else {
            // Jika validasi berhasil, melakukan hashing pada password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            // Menyimpan data pengguna baru ke database
            $query = "INSERT INTO users (email, nomor, password) VALUES ('$email', '$nomor', '$hashedPassword')";
            if (mysqli_query($koneksi, $query)) { // Menjalankan query dan mengecek hasilnya
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
                exit;
            } else {
                $message = 'Registrasi gagal: ' . mysqli_error($koneksi); // Menampilkan error jika query gagal
            }
        }
    }
    // Jika ada pesan error, tampilkan dalam bentuk alert
    if (isset($message)) {
        echo "<script>alert('$message');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
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
        .registration-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        .registration-container h2 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="background"></div>
<div class="registration-container">
    <h2 class="text-center">Register</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required> <!-- Input untuk email -->
        </div>
        <div class="form-group">
            <label for="nomor">Nomor Handphone</label>
            <input type="tel" class="form-control" id="nomor" name="nomor" placeholder="Enter phone number" 
                   minlength="10" maxlength="15" required title="Nomor telepon harus berupa angka dengan panjang 10-15 karakter"> <!-- Input untuk nomor telepon -->
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required> <!-- Input untuk password -->
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required> <!-- Input untuk konfirmasi password -->
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button> <!-- Tombol untuk submit form -->
        <div class="text-center mt-3">
            <p>Already have an account? <a href="login.php" class="text-primary">Login here</a></p> <!-- Link menuju halaman login -->
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
