<?php
include 'koneksi.php';

# [AKSI GANTI PASSWORD]
if (isset($_POST['btn_ganti'])) {
    $nim            = $_POST['nim'];
    $pass_lama      = $_POST['pass_lama']; // Input baru
    $pass_baru      = $_POST['pass_baru'];
    $pass_konf      = $_POST['pass_konf'];

    # 1. Cari User berdasarkan NIM
    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE nim = '$nim'");

    if (mysqli_num_rows($cek_user) === 1) {
        $data = mysqli_fetch_assoc($cek_user);

        # 2. VERIFIKASI PASSWORD LAMA
        # Kita cek apakah password lama yang diinput sesuai dengan database
        if (password_verify($pass_lama, $data['password'])) {
            
            # 3. Cek kesesuaian Password Baru dan Konfirmasi
            if ($pass_baru === $pass_konf) {
                
                # 4. Hash Password Baru
                $password_hash = password_hash($pass_baru, PASSWORD_DEFAULT);

                # 5. Update Password di Database
                $update = mysqli_query($koneksi, "UPDATE users SET password = '$password_hash' WHERE nim = '$nim'");

                if ($update) {
                    echo "<script>
                            alert('Password berhasil diganti! Silakan login dengan password baru.');
                            document.location.href = 'index.php';
                          </script>";
                } else {
                    $error_msg = "Gagal mengupdate password, terjadi kesalahan sistem.";
                }

            } else {
                $error_msg = "Konfirmasi password baru tidak cocok!";
            }

        } else {
            $error_msg = "Password Lama Anda salah!";
        }

    } else {
        $error_msg = "NIM tidak ditemukan! Pastikan NIM Anda benar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - SI-Mading</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-gray-50 bg-[url('assets/whitediamond.png')] bg-repeat bg-fixed min-h-screen">

    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg p-8">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Ganti Password</h1>
            <p class="text-gray-500 text-sm">Masukan data akun untuk verifikasi</p>
        </div>

        <?php if(isset($error_msg)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi NIM</label>
                <input type="text" name="nim" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukan NIM Anda">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Lama</label>
                <input type="password" name="pass_lama" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukan Password Lama">
            </div>

            <hr class="border-gray-200 my-4"> <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password Baru</label>
                <input type="password" name="pass_baru" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Password Baru">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Ulangi Password Baru</label>
                <input type="password" name="pass_konf" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Ketik Ulang Password Baru">
            </div>

            <button type="submit" name="btn_ganti"
                class="w-full bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                       hover:from-[#1565C0] hover:to-[#1E88E5]
                       text-white font-semibold py-3 rounded-lg 
                       shadow-md shadow-blue-300 transition-all duration-300 hover:scale-105">
                Simpan Password Baru
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="index.php" class="text-sm text-gray-500 hover:text-gray-800 transition-colors">
                &larr; Kembali ke halaman Login
            </a>
        </div>
    </div>

</body>
</html>