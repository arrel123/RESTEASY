
<?php
// Nama File : update_kamar.php
// Deskripsi : File ini sebagai proses untuk mengubah data kamar ke database
// Dibuat Oleh : Windy Yohana Gurning (NIM: 3312401066) & Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 18 November 2024 - 29 Desember 2024

/*
Pseudocode:

1. Mulai
2. Cek jika metode request adalah POST (form dikirim):
    2.1 Ambil data input dari form (id, tipe, kasur, fasilitas, harga, rekomendasi, tersedia)
    2.2 Cek jika ada gambar baru yang diunggah:
        2.2.1 Jika ada gambar baru, pindahkan gambar tersebut ke folder 'images' dan buat query update dengan nama gambar yang baru
        2.2.2 Jika tidak ada gambar baru, buat query update tanpa perubahan pada gambar
    2.3 Eksekusi query update untuk memperbarui data kamar di database
    2.4 Jika query berhasil, arahkan ke halaman 'data_kamar.php'
    2.5 Jika query gagal, tampilkan pesan error
3. Akhiri
*/

include 'koneksi.php';

// Memeriksa apakah data form dikirim menggunakan metode POSTs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tipe = $_POST['tipe'];
    $kasur = $_POST['kasur'];
    $fasilitas = $_POST['fasilitas'];
    $harga = $_POST['harga'];
    $rekomendasi = isset($_POST['rekomendasi']) ? $_POST['rekomendasi'] : 0;
    $tersedia = isset($_POST['tersedia']) ? $_POST['tersedia'] : 0;

    // Cek apakah ada gambar baru yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target = "images/" . basename($gambar);

        // Pindahkan file gambar baru
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $query = "UPDATE kamar SET tipe='$tipe', kasur='$kasur', fasilitas='$fasilitas', harga='$harga', rekomendasi='$rekomendasi', tersedia='$tersedia', gambar='$gambar' WHERE id='$id'";
        } else {
            echo "Gagal mengunggah gambar.";
            exit;
        }
    } else {
        // Jika tidak ada gambar baru, perbarui data tanpa mengubah gambar
        $query = "UPDATE kamar SET tipe='$tipe', kasur='$kasur', fasilitas='$fasilitas', harga='$harga', rekomendasi='$rekomendasi', tersedia='$tersedia' WHERE id='$id'";
    }

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header("Location: data_kamar.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . mysqli_error($koneksi);
    }
}
?>
