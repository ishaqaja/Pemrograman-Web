<?php
#bergun menyimpan data pengguna di server seperti nama, password, role dan lain sebagainya
session_start(); // Pastikan session start ada paling atas
include 'koneksi.php';

# [CEK KEAMANAN - OPTIONAL]
# Jika ini halaman khusus admin, biarkan kode cek login ini.
# Jika ini halaman register umum, kamu bisa hapus blok IF ini.
#isset untuk mengecek apakah status sudah login atau velum dan role nya admin (ngecek variabel sudah ada adata atau sdh ada isinya)
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login" || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit;
}

$error_msg = ""; // Variabel untuk menampung pesan error
$success_msg = ""; // Variabel untuk menampung pesan sukses

# [AKSI DAFTAR]
if (isset($_POST['btn_daftar'])) {
    
    $nim      = $_POST['nim'];
    $nama     = $_POST['nama'];
    $password = $_POST['password'];
    $role     = 'mahasiswa'; 

    # -----------------------------------------------------------
    # [VALIDASI NIM GANDA]
    # -----------------------------------------------------------
    $cek_nim = mysqli_query($koneksi, "SELECT nim FROM users WHERE nim = '$nim'");

    if (mysqli_num_rows($cek_nim) > 0) {
        # [JIKA NIM SUDAH ADA]
        # Jangan pakai alert javascript, tapi simpan ke variabel $error_msg
        $error_msg = "NIM yang di regist sudah terdaftar!";
    
    } else {
        # [JIKA NIM BELUM ADA -> LANJUT SIMPAN]
        
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (nim, nama_lengkap, password, role) #Query = kalimat perintah untuk mengambil, menambah, mengubah, atau menghapus data di database.
                  VALUES ('$nim', '$nama', '$pass_hash', '$role')";

        if (mysqli_query($koneksi, $query)) {
            # Sukses
            echo "<script>
                    alert('Akun berhasil ditambahkan!');
                    window.location = 'beranda.php'; 
                  </script>";
        } else {
            $error_msg = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun - SI-Mading</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-[url('assets/whitediamond.png')]">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Akun</h1>
            <a href="beranda.php" class="text-blue-600 hover:underline text-sm font-bold">Kembali</a>
        </div>

        <form action="" method="POST">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                <!-- Tambahkan value php agar kalau error, isian tidak hilang -->
                <input type="text" name="nim" required 
                    value="<?= isset($nim) ? $nim : '' ?>"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukkan NIM Mahasiswa">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" required 
                    value="<?= isset($nama) ? $nama : '' ?>"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Nama Mahasiswa">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Awal</label>
                <input type="text" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukkan Password">
                <p class="text-xs text-gray-500 mt-1">Berikan password ini ke mahasiswa.</p>
            </div>

            <!-- [BAGIAN PESAN ERROR - UI] -->
            <!-- Hanya muncul jika variabel $error_msg ada isinya -->
            <?php if (!empty($error_msg)): ?>
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded shadow-sm flex items-center gap-2 animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm font-bold"><?= $error_msg ?></span>
                </div>
            <?php endif; ?>

            <button type="submit" name="btn_daftar"
                class="w-full bg-gradient-to-r from-blue-500 to-blue-500 hover:from-green-600 hover:to-green-600 text-white font-bold py-3 rounded-lg shadow-md transition-all hover:scale-105">
                Simpan Akun
            </button>

        </form>

    </div>

</body>
</html>