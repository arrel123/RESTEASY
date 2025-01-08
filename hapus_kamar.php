<?php
// Nama File : hapus_kamar.php
// Deskripsi : File ini sebagai proses untuk menghapus data kamar yang ada
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November - 28 Desember 2024

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