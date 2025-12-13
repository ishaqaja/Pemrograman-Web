<?php
session_start();
include 'koneksi.php';

// 1. Cek apakah ada ID yang dikirim? (misal: hapus.php?id=5)
if (isset($_GET['id'])) {
    $id_mading = $_GET['id'];
    
    // 2. Ambil data gambar dulu (Kita harus hapus gambar dari folder juga biar gak nyampah)
    $query_cek = "SELECT gambar FROM mading WHERE id_mading = '$id_mading'";
    $hasil_cek = mysqli_query($koneksi, $query_cek);
    $data      = mysqli_fetch_assoc($hasil_cek);

    // Hapus file gambar di folder 'uploads'
    $lokasi_gambar = "uploads/" . $data['gambar'];
    if (file_exists($lokasi_gambar)) {
        unlink($lokasi_gambar); // Fungsi PHP untuk menghapus file
    }

    // 3. Hapus data dari Database
    $query_hapus = "DELETE FROM mading WHERE id_mading = '$id_mading'";
    
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>
                alert('Mading berhasil dihapus!');
                window.location = 'beranda.php';
              </script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($koneksi);
    }

} else {
    // Kalau user iseng buka file hapus.php tanpa ID
    header("Location: beranda.php");
}
?>