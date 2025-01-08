<?php
// Nama File : logout.php
// Deskripsi : File ini sebagai proses untuk menghapus session yang sedang berlangsung
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 20 Desember 2024

/*
Pseudocode:

1. Mulai
2. Inisialisasi sesi:
    - Panggil session_start() untuk memulai sesi dan memastikan akses ke sesi yang benar
3. Hapus Data Session:
    - Panggil session_unset() untuk menghapus semua variabel session yang ada
    - Panggil session_destroy() untuk menghancurkan sesi secara keseluruhan
4. Redirect ke Halaman Awal:
    - Arahkan pengguna ke halaman utama (resteasy.php)
5. Akhiri
*/

session_start(); // Memulai sesi untuk memastikan kita mengakses sesi yang benar
session_unset(); // Menghapus semua variabel session yang tersimpan
session_destroy(); // Menghancurkan sesi secara keseluruhan

header("Location: resteasy.php");
exit();
?>
