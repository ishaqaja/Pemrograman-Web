<?php
session_start();
include 'koneksi.php';

// Cek Keamanan: Cuma Admin yang boleh akses
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'admin') {
    header("Location: beranda.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Ubah status jadi APPROVED
    $query = "UPDATE mading SET status = 'approved' WHERE id_mading = '$id'";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Mading berhasil disetujui dan diterbitkan!'); window.location='beranda.php';</script>";
    }
}
?>