<?php
// Nama File : buat_invoice.php
// Deskripsi : File ini untuk menampilkan membuat dan menampilkan invoice setelah pelanggan mengisi form pemesanan
// Dibuat Oleh : Rafi Akhbar Dirgahayuri (NIM: 3312401065)
// Tanggal Dibuat : 20 Desember 2024 - 29 Desember 2024

session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

// Periksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ambil data dari formulir dan sanitasi input
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $phone = mysqli_real_escape_string($koneksi, $_POST['phone']);
    $check_in = mysqli_real_escape_string($koneksi, $_POST['checkin']);
    $check_out = mysqli_real_escape_string($koneksi, $_POST['checkout']);
    $adults = (int)$_POST['adults'];
    $children = (int)$_POST['children'];
    $room_id = mysqli_real_escape_string($koneksi, $_POST['room-type']);
    $request = mysqli_real_escape_string($koneksi, $_POST['request']);

    // Ambil harga kamar
    $roomQuery = mysqli_query($koneksi, "SELECT * FROM kamar WHERE id = '$room_id'");
    $roomData = mysqli_fetch_assoc($roomQuery);
    $roomPrice = $roomData['harga'];

    // Hitung total
    $checkIn_Date = new DateTime($check_in);
    $checkOut_Date = new DateTime($check_out);
    $interval = $checkIn_Date->diff($checkOut_Date);
    $totalMalam = $interval->days;
    $total = $totalMalam * $roomPrice;

    // Ambil ID pemesanan terakhir
    $result = mysqli_query($koneksi, "SELECT MAX(id) AS lastId FROM pemesanan");
    $data = mysqli_fetch_assoc($result);
    $lastId = $data['lastId'] ?? 0; // Jika tidak ada pemesanan sebelumnya, mulai dari 0
    $orderId = $lastId + 1; // Tambah 1 untuk ID pemesanan baru

    // Buat format invoice dengan format Ymd-kode kamar-id pemesanan
    $invoice = date('Ymd') . '-' . $room_id . '-' . str_pad($orderId, 4, '0', STR_PAD_LEFT); 

    // Masukkan data pemesanan ke tabel pemesanan
    $queryPemesanan = "INSERT INTO pemesanan (name, phone, check_in, check_out, adults, children, room_id, request)
                      VALUES ('$name', '$phone', '$check_in', '$check_out', $adults, $children, '$room_id', '$request')";
    if (mysqli_query($koneksi, $queryPemesanan)) {
        // Masukkan data transaksi ke tabel transaksi
        $queryTransaksi = "INSERT INTO transaksi (invoice, nama, total, status)
                          VALUES ('$invoice', '$name', $total, 'Pending')";
        if (mysqli_query($koneksi, $queryTransaksi)) {
            // Setelah pemesanan dan transaksi berhasil, generate PDF invoice

            require('fpdf/fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);

            // Header Invoice
            $pdf->Cell(0, 10, 'Invoice RestEasy', 0, 1, 'C');
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Nomor Invoice: ' . $invoice, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1, 'L');
            $pdf->Ln(5);

            // Data Pemesan
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'Detail Pemesan:', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Nama: ' . $name, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Telepon: ' . $phone, 0, 1, 'L');
            $pdf->Ln(5);

            // Data Pemesanan
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'Detail Pemesanan:', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Tipe Kamar: ' . $roomData['tipe'], 0, 1, 'L');
            $pdf->Cell(0, 10, 'Harga Kamar/Malam: Rp ' . number_format($roomPrice, 0, ',', '.'), 0, 1, 'L');
            $pdf->Cell(0, 10, 'Tanggal Check-In: ' . $check_in, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Tanggal Check-Out: ' . $check_out, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Jumlah Tamu Dewasa: ' . $adults, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Jumlah Tamu Anak-anak: ' . $children, 0, 1, 'L');
            $pdf->Cell(0, 10, 'Jumlah Malam: ' . $totalMalam, 0, 1, 'L');
            $pdf->Ln(5);

            // Permintaan Khusus
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'Permintaan Khusus:', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->MultiCell(0, 10, $request ? $request : '-', 0, 'L');

            // Total Bayar
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(0, 10, 'Total Bayar:', 0, 1, 'L');
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, 'Rp ' . number_format($total, 0, ',', '.'), 0, 1, 'L');

            // Catatan Untuk Pelanggan
            $pdf->SetFont('Arial', 'I', 12);
            $pdf->Ln(10);
            $note = "Diharap menyimpan invoice ini untuk mengkonfirmasi pesanan anda dengan staf hotel kami.";
            $pdf->MultiCell(0, 10, $note, 0, 'C');

            // Tampilkan PDF
            $filename = "Invoice_$invoice.pdf";
            $pdf->Output('F', 'invoices/' . $filename); // Menyimpan file dalam folder invoices
            $pdf_path = 'invoices/' . $filename;

            // HTML untuk menampilkan pesan setelah invoice berhasil dibuat
            echo "
            <!DOCTYPE html>
            <html lang='id'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Invoice</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                        background-color: #f4f4f4;
                    }
                    .container {
                        text-align: center;
                        background-color: white;
                        padding: 30px;
                        border-radius: 8px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .btn-download {
                        display: inline-block;
                        background-color: #007bff;
                        color: white;
                        padding: 12px 20px;
                        font-size: 16px;
                        border: none;
                        border-radius: 5px;
                        text-decoration: none;
                        margin-top: 20px;
                    }
                    .btn-back {
                        display: inline-block;
                        background-color: #28a745;
                        color: white;
                        padding: 12px 20px;
                        font-size: 16px;
                        border: none;
                        border-radius: 5px;
                        text-decoration: none;
                        margin-top: 10px;
                    }
                    .btn-download:hover {
                        background-color: #0056b3;
                    }
                    .btn-back:hover {
                        background-color: #218838;
                    }
                    h1 {
                        font-size: 24px;
                        margin-bottom: 20px;
                    }
                    p {
                        font-size: 18px;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <h1>Invoice Anda Telah Dibuat</h1>
                    <p>Nomor Invoice: <strong>$invoice</strong></p>
                    <p>Silakan klik tombol di bawah untuk mengunduh PDF Invoice Anda.</p>
                    <a href='$pdf_path' class='btn-download' download>Unduh PDF</a>
                    <br>
                    <a href='dashboard2.php' class='btn-back'>Kembali ke Dashboard</a>
                </div>
            </body>
            </html>";
            exit();
        } else {
            // Tampilkan error jika query transaksi gagal
            echo "Error: " . $queryTransaksi . "<br>" . $koneksi->error;
        }
    } else {
        // Tampilkan error jika query pemesanan gagal
        echo "Error: " . $queryPemesanan . "<br>" . $koneksi->error;
    }
}

// Tutup koneksi
$koneksi->close();
?>
