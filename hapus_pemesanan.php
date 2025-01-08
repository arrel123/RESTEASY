<?php
// Nama File : hapus_pemesanan.php
// Deskripsi : Proses untuk menghapus data pemesanan berdasarkan ID
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 22 Desember 2024 - 28 Desember 2024

include 'koneksi.php';

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus pemesanan
    if (mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id = $id")) {
        header("Location: pemesanan.php"); // Redirect setelah penghapusan berhasil
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.href='pemesanan.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid atau tidak ditemukan!'); window.location.href='pemesanan.php';</script>";
}
?>
