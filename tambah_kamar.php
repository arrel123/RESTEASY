
<?php
// Nama File : tambah_kamar.php
// Deskripsi : File ini sebagai proses untuk menambahkan data kamar ke database
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November 2024 - 29 Desember 2024

/*
Pseudocode:

1. Mulai
2. Cek jika metode request adalah POST (form dikirim):
    2.1 Ambil data input dari form (id, tipe, kasur, fasilitas, harga, rekomendasi, tersedia, gambar)
    2.2 Simpan data gambar (pindahkan gambar dari direktori sementara ke folder 'images')
    2.3 Query untuk menyimpan data kamar ke database:
        2.3.1 Masukkan data kamar ke dalam tabel 'kamar' dengan nilai input yang diambil dari form
    2.4 Jika query berhasil, tampilkan pesan sukses dan arahkan ke halaman 'data_kamar.php'
    2.5 Jika query gagal, tampilkan pesan error dan arahkan ke halaman 'data_kamar.php'
3. Akhiri
*/

include 'koneksi.php';

// Memeriksa apakah data form dikirim menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $tipe = $_POST['tipe'];
    $kasur = $_POST['kasur'];
    $fasilitas = $_POST['fasilitas'];
    $harga = $_POST['harga'];
    $rekomendasi = isset($_POST['rekomendasi']) ? $_POST['rekomendasi'] : 0;
    $tersedia = isset($_POST['tersedia']) ? $_POST['tersedia'] : 0;
    
    // Proses gambar
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = 'images/' . $gambar;
    
    // Pindahkan gambar ke folder images
    move_uploaded_file($gambar_tmp, $gambar_path);
    
    // Query untuk menyimpan data
    $query = "INSERT INTO kamar (id, tipe, kasur, fasilitas, harga, gambar, rekomendasi, tersedia) VALUES ('$id', '$tipe', '$kasur', '$fasilitas', '$harga', '$gambar', '$rekomendasi', '$tersedia')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data kamar berhasil ditambahkan!'); window.location.href='data_kamar.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data kamar!'); window.location.href='data_kamar.php';</script>";
    }
}
?> 
