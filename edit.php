
<?php
// Nama File : edit.php
// Deskripsi : File ini membolehkan pengguna mengganti Nama, Alamat, dan Kata sandi
// Dibuat Oleh : Saskia Ananda Irawan (NIM: 3312401070) & Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 19 Desember 2024 - 29 Desember 2024

session_start();
include 'koneksi.php'; 

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$error = "";

// Ambil data pengguna dari tabel database users
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}

$user = mysqli_fetch_assoc($result);

// Proses untuk mengubah nama, alamat, dan password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_profile'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        // Update nama dan alamat
        $queryUpdate = "UPDATE users SET nama = '$nama', alamat = '$alamat' WHERE email = '$email'";
        if (mysqli_query($koneksi, $queryUpdate)) {
            $message = "Profil berhasil diperbarui!";
        } else {
            $error = "Gagal memperbarui profil!";
        }
    }

    if (isset($_POST['update_password'])) {
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        $confirmPass = $_POST['confirmPass'];

        // Verifikasi password lama
        if (password_verify($oldPass, $user['password'])) {
            // Verifikasi password baru dan konfirmasi password
            if ($newPass === $confirmPass) {
                $newPass_hash = password_hash($newPass, PASSWORD_DEFAULT);

                // Update password
                $queryUpdatePass = "UPDATE users SET password = '$newPass_hash' WHERE email = '$email'";
                if (mysqli_query($koneksi, $queryUpdatePass)) {
                    $message = "Password berhasil diperbarui!";
                } else {
                    $error = "Gagal memperbarui password!";
                }
            } else {
                $error = "Password baru dan konfirmasi password tidak cocok!";
            }
        } else {
            $error = "Password lama salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
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
            filter: blur(3px);
            z-index: 1;
        }
        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }
        .container h2 {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <h2 class="text-center">RestEasy</h2>
        <h5 class="text-center">Edit Profil</h5>

        <!-- Tampilkan pesan error atau sukses -->
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php elseif (!empty($message)) : ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Menampilkan data pengguna -->
        <p><strong>Nama: </strong><span id="current-nama"><?php echo htmlspecialchars($user['nama']); ?></span></p>
        <p><strong>Alamat: </strong><span id="current-alamat"><?php echo htmlspecialchars($user['alamat']); ?></span></p>

        <button class="btn btn-warning" data-toggle="modal" data-target="#editProfileModal">Ganti Nama dan Alamat</button>
        <button class="btn btn-info" data-toggle="modal" data-target="#changePasswordModal">Ganti Password</button>
        <a href="dashboard2.php" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Modal untuk mengubah nama dan alamat -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProfileModalLabel">Ubah Nama dan Alamat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required><?php echo htmlspecialchars($user['alamat']); ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="update_profile">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk mengubah password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="oldPass">Password Lama</label>
                            <input type="password" class="form-control" id="oldPass" name="oldPass" required>
                        </div>
                        <div class="form-group">
                            <label for="newPass">Password Baru</label>
                            <input type="password" class="form-control" id="newPass" name="newPass" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPass">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirmPass" name="confirmPass" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="update_password">Ganti Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>