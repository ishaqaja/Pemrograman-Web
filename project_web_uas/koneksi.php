<?php
#konfigurasi server database
$server   = "localhost";
$user     = "root";
$password = "";
$database = "db_mading"; // Pastikan ini sama dengan di phpMyAdmin

#menjalankan proses koneksi menggunakan fungsi
$koneksi = mysqli_connect($server, $user, $password, $database); #sintax connection

#Jika koneksi gagal, hentikan program (die()).
if (!$koneksi) {
    die("Gagal terhubung: " . mysqli_connect_error()); # jika gagal makia dia akan di jalankan sebagai code untuk menghentikan perintah
}
?>