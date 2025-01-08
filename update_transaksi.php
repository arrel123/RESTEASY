<?php
// Nama File : update_transaksi.php
// Deskripsi : File ini sebagai proses untuk mengubah data transaksi di dalam database
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November 2024 - 28 Desember 2024

// Menghubungkan file dengan koneksi ke database
include 'koneksi.php';

// Memeriksa apakah data form dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $invoice = $_POST['invoice']; 
    $status = $_POST['status']; 

    // Query untuk update data transaksi di database berdasarkan invoice
    $query = "UPDATE transaksi SET status='$status' WHERE invoice='$invoice'";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header("Location: data_transaksi.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
