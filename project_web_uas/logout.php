<?php
session_start();

// 1. Hapus semua sesi (Lupa ingatan kalau user pernah login)
session_unset();
session_destroy();

// 2. Tendang kembali ke halaman Login
echo "<script>
        alert('Anda berhasil logout!');
        window.location = 'beranda.php';
      </script>";
exit;
?>