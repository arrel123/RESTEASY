<?php
// Nama File : hapus_kamar.php
// Deskripsi : File ini sebagai proses untuk menghapus data kamar yang ada
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November - 28 Desember 2024

/*
Pseudocode:

1. Mulai
2. Periksa sesi untuk memastikan pengguna memiliki hak akses sebagai admin:
    2.1 Jika tidak memiliki role 'admin', arahkan ke halaman login dan akhiri eksekusi
3. Ambil ID kamar yang akan dihapus dari parameter URL (GET)
4. Periksa apakah ada pemesanan yang terkait dengan kamar yang akan dihapus:
    4.1 Jika ada pemesanan, tampilkan pesan bahwa kamar tidak bisa dihapus dan arahkan kembali ke halaman data_kamar.php
5. Lakukan query DELETE untuk menghapus kamar berdasarkan ID
6. Jika penghapusan berhasil, arahkan ke halaman data_kamar.php
7. Jika penghapusan gagal, tampilkan pesan error dan arahkan kembali ke halaman data_kamar.php
8. Akhiri
*/

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$id = $_GET['id'];

// Cek apakah ada pemesanan terkait
$check = mysqli_query($koneksi, "SELECT * FROM pemesanan WHERE room_id = '$id'");
if (mysqli_num_rows($check) > 0) {
    echo "<script>alert('Tidak dapat menghapus kamar karena ada pemesanan terkait!'); window.location.href='data_kamar.php';</script>";
    exit();
}

    // Query untuk menghapus kamar
    if (mysqli_query($koneksi, "DELETE FROM kamar WHERE id = '$id'")) {
        header("Location: data_kamar.php"); // Redirect setelah penghapusan berhasil
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.href='data_kamar.php';</script>";
}
?>
