<?php
session_start();
include 'koneksi.php';

# ============================================================
# [KEAMANAN: CEK LOGIN & CEK ROLE]
# ============================================================

# 1. Cek apakah user sudah login?
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: index.php");
    exit;
}

# 2. Cek apakah user adalah ADMIN?
# Jika role user BUKAN admin, tolak aksesnya.
if ($_SESSION['role'] != 'admin') {
    echo "<script>
            alert('AKSES DITOLAK! Anda tidak memiliki izin mengakses halaman ini.');
            window.location = 'beranda.php';
          </script>";
    exit; # Penting: Hentikan script agar orang iseng tidak bisa melihat form di bawah.
}
# ============================================================

# [AMBIL ID DARI URL]
$id_mading = $_GET['id'];

# [AMBIL DATA LAMA]
$query  = "SELECT * FROM mading WHERE id_mading = '$id_mading'";
$result = mysqli_query($koneksi, $query);

# Cek apakah id mading valid/ada di database
if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data mading tidak ditemukan!'); window.location='beranda.php';</script>";
    exit;
}

$data   = mysqli_fetch_assoc($result);

# [AKSI UPDATE]
if (isset($_POST['btn_update'])) {
    $judul      = $_POST['judul'];
    $kategori   = $_POST['kategori'];
    $deskripsi  = $_POST['deskripsi'];

    # [LOGIKA GANTI FOTO]
    if ($_FILES['foto']['name'] != "") {

        # Hapus foto lama
        $gambar_lama = "uploads/" . $data['gambar'];
        if (file_exists($gambar_lama)) {
            unlink($gambar_lama);
        }

        # Upload foto baru
        $foto_nama = $_FILES['foto']['name'];
        $foto_tmp  = $_FILES['foto']['tmp_name'];
        $nama_baru = rand(100,9999) . '_' . $foto_nama;
        move_uploaded_file($foto_tmp, "uploads/" . $nama_baru);

        # Update dengan gambar
        $query_update = "UPDATE mading SET 
                         judul='$judul', kategori='$kategori', deskripsi='$deskripsi', gambar='$nama_baru'
                         WHERE id_mading='$id_mading'";
    } else {
        # Update tanpa gambar
        $query_update = "UPDATE mading SET 
                         judul='$judul', kategori='$kategori', deskripsi='$deskripsi'
                         WHERE id_mading='$id_mading'";
    }

    # Eksekusi Query
    if (mysqli_query($koneksi, $query_update)) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='beranda.php';</script>";
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Mading - SI-Mading</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 flex items-center justify-center bg-gray-50 bg-[url('assets/whitediamond.png')] bg-repeat bg-fixed min-h-screen">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Mading</h2>
            <a href="beranda.php" class="text-blue-600 hover:underline font-bold">Batal</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
                <input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Akademik" <?= ($data['kategori'] == 'Akademik') ? 'selected' : '' ?>>Akademik</option>
                    <option value="Kesehatan"     <?= ($data['kategori'] == 'Kesehatan') ? 'selected' : '' ?>>Kesehatan</option>
                    <option value="Event"     <?= ($data['kategori'] == 'Event') ? 'selected' : '' ?>>Event</option>
                    <option value="Lomba"     <?= ($data['kategori'] == 'Lomba') ? 'selected' : '' ?>>Lomba</option>
                    <option value="Lainnya"   <?= ($data['kategori'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ganti Gambar (Opsional)</label>
                <div class="flex items-start gap-4">
                    <img src="uploads/<?= $data['gambar'] ?>" class="w-24 h-24 object-cover rounded border bg-gray-50">
                    <div class="flex-1">
                        <input type="file" name="foto" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    </div>
                </div>
            </div>

            <button type="submit" name="btn_update"
                class="w-full bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                       hover:from-[#1565C0] hover:to-[#1E88E5]
                       text-white font-semibold py-3 rounded-lg 
                       shadow-md shadow-blue-300 transition-all duration-300 hover:scale-105">
                Simpan Perubahan
            </button>

        </form>
    </div>

</body>
</html>