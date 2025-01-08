<?php
// Nama File : logout.php
// Deskripsi : File ini sebagai proses untuk menghapus session yang sedang berlangsung
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 20 Desember 2024

session_start(); // Memulai sesi untuk memastikan kita mengakses sesi yang benar
session_unset(); // Menghapus semua variabel session yang tersimpan
session_destroy(); // Menghancurkan sesi secara keseluruhan

header("Location: resteasy.php");
exit();
?>