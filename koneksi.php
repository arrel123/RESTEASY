<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "hotel";

$koneksi = mysqli_connect($host, $user, $password, $db);
if(!$koneksi){
    echo "Gagal Konek:" .die(mysqli_error($koneksi));
}