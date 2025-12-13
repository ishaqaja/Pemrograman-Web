<?php
session_start();
include 'koneksi.php';

if (isset($_POST['btn_simpan']) && isset($_SESSION['id_user'])) {
    $judul      = $_POST['judul'];
    $kategori   = $_POST['kategori'];
    $deskripsi  = $_POST['deskripsi'];
    $id_user    = $_SESSION['id_user'];
    $role       = $_SESSION['role']; // Cek Role User
    $tanggal    = date('Y-m-d');

    // LOGIKA STATUS
    // Jika Admin: Langsung 'approved'. Jika Mahasiswa: 'pending'
    $status = ($role == 'admin') ? 'approved' : 'pending';

    $foto = $_FILES['foto'];
    $nama_baru = rand(100, 9999) . '_' . $foto['name'];
    
    if (move_uploaded_file($foto['tmp_name'], 'uploads/' . $nama_baru)) {
        
        $query = "INSERT INTO mading (judul, deskripsi, gambar, kategori, tanggal_upload, id_user, status) 
                  VALUES ('$judul', '$deskripsi', '$nama_baru', '$kategori', '$tanggal', '$id_user', '$status')";
        
        if (mysqli_query($koneksi, $query)) {
            // Pesan alert beda untuk Admin dan Mahasiswa
            if ($role == 'admin') {
                echo "<script>alert('Mading berhasil diterbitkan!'); window.location = 'beranda.php';</script>";
            } else {
                echo "<script>alert('Permintaan terkirim! Mading akan tampil setelah disetujui Admin.'); window.location = 'beranda.php';</script>";
            }
        } else {
            echo "Gagal DB: " . mysqli_error($koneksi);
        }

    } else {
        echo "Gagal Upload Gambar.";
    }

} else {
    header("Location: beranda.php");
}
?>