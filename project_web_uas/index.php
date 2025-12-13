<?php
session_start();
include 'koneksi.php';

# [AKSI LOGIN]
if (isset($_POST['btn_login'])) {
    $nim      = $_POST['nim'];
    $password = $_POST['password'];

    # 1. Cari User berdasarkan NIM
    $query  = "SELECT * FROM users WHERE nim = '$nim'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);

        # 2. Cek Password
        # Catatan: Karena data awal diinput admin, password default juga harus di-hash dulu.
        if (password_verify($password, $data['password'])) {
            
            # Login Sukses -> Buat Tiket
            $_SESSION['status']   = "login";
            $_SESSION['id_user']  = $data['id_user'];
            $_SESSION['nama']     = $data['nama_lengkap'];
            $_SESSION['role']     = $data['role'];

            header("Location: beranda.php");
            exit;
        } else {
            $error_msg = "Password salah!";
        }
    } else {
        $error_msg = "NIM tidak ditemukan. Hubungi Admin jika belum terdaftar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SI-Mading</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen bg-gray-50 bg-[url('assets/whitediamond.png')] bg-repeat bg-fixed min-h-screen">

    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg p-8">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Login</h1>
            <p class="text-gray-500 text-sm">Silakan masuk menggunakan NIM Anda</p>
        </div>

        <?php if(isset($error_msg)) : ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">NIM</label>
                <input type="text" name="nim" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Masukan NIM">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Masukan Password">
            </div>

            <button type="submit" name="btn_login"
                class="w-full bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                       hover:from-[#1565C0] hover:to-[#1E88E5]
                       text-white font-semibold py-3 rounded-lg 
                       shadow-md shadow-blue-300 transition-all duration-300 hover:scale-105">
                Masuk Sistem
            </button>
        </form>

        <!-- [TAMBAHAN: TOMBOL GANTI PASSWORD] -->
        <div class="mt-4 text-center">
            <a href="ganti_password.php" class="text-sm text-blue-500 hover:text-blue-700 hover:underline transition-colors">
                Ingin ganti password? Klik disini
            </a>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-100 text-center text-sm text-gray-500">
            <p>Belum punya akun?</p>
            
            <!-- [LINK WHATSAPP ADMIN] -->
            <a href="https://wa.me/6285654174569?text=Halo%20Admin,%20saya%20ingin%20mendaftar%20akun%20SI-Mading." target="_blank" class="font-bold text-gray-700 hover:text-green-600 transition-colors flex items-center justify-center gap-1 mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                Silakan lapor ke Admin Kampus
            </a>
        </div>
    </div>

</body>
</html>