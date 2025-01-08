<?php
// Nama File : reset_password.php
// Deskripsi : File ini sebagai proses sekaligus formulir untuk mengganti password pengguna
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November - 29 Desember 2024

include 'koneksi.php';

// Mengecek jika form dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $newPass = trim($_POST['pass']);
    $confirmPass = trim($_POST['confirmPass']);

    // Validasi input jika ada field yang kosong
    if (empty($email) || empty($newPass) || empty($confirmPass)) {
        echo "<script>alert('Semua field wajib diisi!'); window.location.href='reset_password.php';</script>";
        exit;
    } elseif ($newPass !== $confirmPass) { // Validasi jika password dan konfirmasi tidak cocok
        echo "<script>alert('Password dan konfirmasi password tidak cocok!'); window.location.href='reset_password.php';</script>";
        exit;
    } else {
        // Melakukan hashing pada password baru
        $passHash = password_hash($newPass, PASSWORD_BCRYPT);

        // Query untuk memperbarui password pengguna berdasarkan email
        $stmt = $koneksi->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $passHash, $email); // Menyisipkan parameter ke query
        $stmt->execute(); // Menjalankan query

        // Mengecek apakah query berhasil memperbarui password
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Ganti password berhasil!'); window.location.href='login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Ganti password gagal! Pastikan email terdaftar.'); window.location.href='reset_password.php';</script>";
            exit;
        }
    }
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestEasy - Reset Password</title>
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
        .login-container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
    </style>
</head>
<body>

<div class="background"></div>
<div class="login-container">
    <h2 class="text-center">RestEasy</h2>
    <h5 class="text-center">Reset Password</h5>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="pass">New Password</label>
            <input type="password" class="form-control" id="pass" name="pass" placeholder="New Password" required>
        </div>
        <div class="form-group">
            <label for="confirmPass">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmPass" name="confirmPass" placeholder="Confirm New Password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
