<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status'])) { header("Location: index.php"); exit; }

$nama_user = $_SESSION['nama'];
$role_user = $_SESSION['role'];
$id_user   = $_SESSION['id_user']; // [PENTING] Tambahkan ini untuk filter query mahasiswa
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SI-MADING</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #555; }
        .gradient-bg { background: linear-gradient(135deg, #ffffffff 0%, #ffffffff 100%); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        .badge-glow { box-shadow: 0 0 10px rgba(239, 68, 68, 0.4); }
    </style>
</head>
<body class="bg-gray-50 bg-[url('assets/whitediamond.png')] bg-repeat bg-fixed min-h-screen">

    <nav class="gradient-bg shadow-xl sticky top-0 z-40 backdrop-blur-lg bg-opacity-95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-4">
                    <img src="assets/website_si_mading.png" alt="Logo" class="h-12 w-auto">
                    <div class="flex flex-col">
                        <span class="text-2xl sm:text-3xl font-extrabold text-black tracking-tight">SI-MADING</span>
                        <span class="text-xs text-white/80 hidden sm:block">Campus Bulletin Board</span>
                    </div>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="hidden md:flex flex-col items-end">
                        <span class="text-sm font-medium text-black">Halo, <?= $nama_user ?></span>
                        <?php if($role_user=='admin'): ?>
                            <span class="text-red-700 text-xs px-2 py-0.5 font-bold">ADMIN</span>
                        <?php endif; ?>
                    </div>

                    <!-- [TOMBOL TAMBAH ANGGOTA - KHUSUS ADMIN] -->
                    <?php if($role_user == 'admin'): ?>
                    <a href="register.php"
                       class="bg-gradient-to-r from-green-500 to-emerald-500
                              hover:from-green-600 hover:to-emerald-600
                              text-white px-3 sm:px-4 py-2.5 rounded-lg text-sm font-semibold 
                              shadow-md shadow-green-200 transition-all duration-300 hover:scale-105 flex items-center gap-2">
                        <span class="hidden sm:inline">Tambah Anggota</span>
                        <span class="sm:hidden text-lg">+</span>
                    </a>
                    <?php endif; ?>

                    <a href="logout.php"
                        class="bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                               hover:from-[#1565C0] hover:to-[#1E88E5]
                               text-white px-4 sm:px-6 py-2.5 rounded-lg text-sm font-semibold 
                               shadow-md shadow-blue-300 transition-all duration-300 hover:scale-105">
                        <span class="hidden sm:inline">Logout</span>
                        <span class="sm:hidden">⎋</span>
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <?php 
        // [LOGIKA SECTION PENDING UNTUK SEMUA USER]
        // Bedanya hanya di Query:
        // - Admin: Lihat SEMUA yang pending.
        // - Mahasiswa: Lihat HANYA punya dia sendiri yang pending.
        
        if ($role_user == 'admin') {
            $query_pending = "SELECT mading.*, users.nama_lengkap 
                              FROM mading 
                              JOIN users ON mading.id_user = users.id_user 
                              WHERE status = 'pending' 
                              ORDER BY id_mading DESC";
            $judul_pending = " Menunggu Persetujuan";
        } else {
            $query_pending = "SELECT mading.*, users.nama_lengkap 
                              FROM mading 
                              JOIN users ON mading.id_user = users.id_user 
                              WHERE status = 'pending' AND mading.id_user = '$id_user' 
                              ORDER BY id_mading DESC";
            $judul_pending = " Status Pengajuan Anda";
        }

        $result_pending = mysqli_query($koneksi, $query_pending);
        
        if (mysqli_num_rows($result_pending) > 0): 
        ?>
        <div class="mb-10 bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-200 rounded-2xl p-6 sm:p-8 shadow-xl fade-in">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h2 class="text-2xl sm:text-3xl font-bold text-amber-900 flex items-center gap-3 mb-3 sm:mb-0">
                    <span class="text-3xl"><?= ($role_user == 'admin') ? '⚠️' : '⏳' ?></span>
                    <span><?= $judul_pending ?></span>
                </h2>
                <span class="bg-amber-500 text-white text-lg font-bold px-4 py-2 rounded-full shadow-lg">
                    <?= mysqli_num_rows($result_pending) ?> Poster
                </span>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <?php while ($row = mysqli_fetch_assoc($result_pending)): ?>
                    <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 p-5 border-l-4 border-amber-500 transform hover:-translate-y-2">
                        <div class="flex flex-col sm:flex-row items-start gap-4 mb-4">
                            <img src="uploads/<?= $row['gambar'] ?>" class="w-full sm:w-20 h-48 sm:h-20 object-cover rounded-lg bg-gray-100 shadow-sm">
                            <div class="flex-1 w-full">
                                <h4 class="font-bold text-gray-900 text-lg mb-1 line-clamp-2"><?= $row['judul'] ?></h4>
                                <p class="text-sm text-gray-600 mb-2">
                                    <span class="font-medium">Oleh:</span> <?= $row['nama_lengkap'] ?>
                                </p>
                                <span class="bg-purple-100 text-black-700 text-xs font-semibold px-3 py-1 rounded-full">
                                    <?= $row['kategori'] ?>
                                </span>
                            </div>
                        </div>

                        <!-- [TOMBOL AKSI] -->
                        <div class="pt-4 border-t border-gray-100">
                            <?php if ($role_user == 'admin'): ?>
                                <!-- JIKA ADMIN: Muncul Tombol Terima/Tolak -->
                                <div class="grid grid-cols-2 gap-3">
                                    <a href="terima.php?id=<?= $row['id_mading'] ?>" 
                                       class="bg-green-500 hover:bg-green-600 text-white text-center py-2 rounded-lg text-sm font-bold transition-all hover:scale-105 shadow-md">
                                        ✅ Terima
                                    </a>
                                    <a href="hapus.php?id=<?= $row['id_mading'] ?>" 
                                       class="bg-red-500 hover:bg-red-600 text-white text-center py-2 rounded-lg text-sm font-bold transition-all hover:scale-105 shadow-md" 
                                       onclick="return confirm('Tolak dan Hapus mading ini?')">
                                        ❌ Tolak
                                    </a>
                                </div>
                            <?php else: ?>
                                <!-- JIKA MAHASISWA: Hanya Pesan Status -->
                                <div class="flex items-center justify-center gap-2 text-amber-600 bg-amber-50 py-2 rounded-lg">
                                    <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="font-bold text-sm">Menunggu Konfirmasi Admin</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif; ?>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-2">Mading Terbaru</h2>
                <p class="text-gray-600 text-sm sm:text-base">Temukan informasi dan poster terbaru dari kampus</p>
            </div>

            <a href="tambah.php"
                class="bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                       hover:from-[#1565C0] hover:to-[#1E88E5]
                       text-white px-6 py-3 rounded-xl shadow-xl shadow-blue-300 
                       flex items-center gap-2 transition-all duration-300 hover:scale-105 
                       font-semibold w-full sm:w-auto justify-center">
                <span class="text-xl"><?= ($role_user == 'admin') ? '➕' : '📝' ?></span>
                <span><?= ($role_user == 'admin') ? 'Pasang Info' : 'Ajukan Poster' ?></span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            <?php
            $query = "SELECT mading.*, users.nama_lengkap 
                      FROM mading 
                      JOIN users ON mading.id_user = users.id_user 
                      WHERE status = 'approved' 
                      ORDER BY id_mading DESC";
            $result = mysqli_query($koneksi, $query);

            if (mysqli_num_rows($result) == 0) {
                echo '<div class="col-span-full">
                        <div class="text-center py-20 bg-white rounded-2xl border-2 border-dashed border-gray-300 fade-in">
                            <div class="text-6xl mb-4">📋</div>
                            <p class="text-xl font-semibold text-gray-400 mb-2">Belum ada mading yang terbit</p>
                            <p class="text-sm text-gray-400">Jadilah yang pertama untuk memposting!</p>
                        </div>
                      </div>';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $judul  = htmlspecialchars($row['judul']);
                    $desc   = htmlspecialchars($row['deskripsi']);
                    $img    = htmlspecialchars($row['gambar']);
                    $author = htmlspecialchars($row['nama_lengkap']);
            ?>
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl card-hover overflow-hidden cursor-pointer group border border-gray-100 fade-in"
                     onclick="bukaModal(this)"
                     data-judul="<?= $judul ?>" 
                     data-kategori="<?= $row['kategori'] ?>" 
                     data-desc="<?= $desc ?>"
                     data-img="<?= $img ?>" 
                     data-author="<?= $author ?>" 
                     data-date="<?= $row['tanggal_upload'] ?>">

                    <div class="relative h-56 sm:h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                        <img src="uploads/<?= $row['gambar'] ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                             alt="<?= $judul ?>">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/95 backdrop-blur-sm text-black-700 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                <?= $row['kategori'] ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-5 sm:p-6">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                            <?= $row['judul'] ?>
                        </h3>
                        
                        <div class="flex items-center gap-4 text-xs sm:text-sm text-gray-500 mb-4">
                            <span class="flex items-center gap-1">
                                <span class="text-base">👤</span>
                                <span class="font-medium"><?= $row['nama_lengkap'] ?></span>
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="text-base">📅</span>
                                <span><?= date('d M Y', strtotime($row['tanggal_upload'])) ?></span>
                            </span>
                        </div>

                        <?php if ($role_user == 'admin') : ?>
                            <div class="flex gap-3 pt-4 border-t border-gray-100" onclick="event.stopPropagation()">
                                <a href="edit.php?id=<?= $row['id_mading'] ?>"
                                    class="flex-1 bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                                           hover:from-[#1565C0] hover:to-[#1E88E5]
                                           text-white font-semibold text-sm py-2.5 rounded-lg 
                                           shadow-md shadow-blue-300 transition-all text-center hover:scale-105">
                                    ✏️ Edit
                                </a>
                                <a href="hapus.php?id=<?= $row['id_mading'] ?>"
                                    class="flex-1 bg-gradient-to-r from-[#1E88E5] to-[#42A5F5]
                                           hover:from-[#1565C0] hover:to-[#1E88E5]
                                           text-white font-semibold text-sm py-2.5 rounded-lg 
                                           shadow-md shadow-blue-300 transition-all text-center hover:scale-105"
                                    onclick="return confirm('Hapus permanen?')">
                                    🗑️ Hapus
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } } ?>
        </div>
    </main>

    <footer class="mt-16 py-8 border-t border-gray-200 bg-white/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-600 text-sm">© <?= date('Y') ?> SI-MADING. Sistem Informasi Mading Kampus.</p>
        </div>
    </footer>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm" onclick="tutupModal()">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl overflow-hidden shadow-2xl w-full max-w-6xl flex flex-col lg:flex-row max-h-[90vh] relative transform transition-all" onclick="event.stopPropagation()">
                <div class="lg:w-3/5 bg-gradient-to-br from-gray-900 to-gray-800 flex items-center justify-center h-64 sm:h-96 lg:h-auto">
                    <img id="modalImg" src="" class="w-full h-full object-contain p-4" alt="Mading Image">
                </div>
                <div class="lg:w-2/5 p-6 sm:p-8 lg:p-10 flex flex-col bg-gradient-to-br from-white to-gray-50 overflow-y-auto custom-scrollbar">
                    <span id="modalKategori" class="bg-purple-100 text-purple-700 text-xs font-bold px-4 py-2 rounded-full w-max mb-4 shadow-sm"></span>
                    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4 leading-tight" id="modalJudul"></h3>
                    <div class="flex items-center gap-4 text-sm text-gray-600 pb-4 mb-4 border-b-2 border-gray-200">
                        <span class="flex items-center gap-2"><span class="text-lg">👤</span><span class="font-semibold" id="modalAuthor"></span></span>
                        <span class="flex items-center gap-2"><span class="text-lg">📅</span><span id="modalDate"></span></span>
                    </div>
                    <div class="flex-1 overflow-y-auto custom-scrollbar mb-6">
                        <p class="text-gray-700 whitespace-pre-wrap leading-relaxed text-sm sm:text-base" id="modalDesc"></p>
                    </div>
                    <button onclick="tutupModal()" class="w-full bg-gradient-to-r from-[#1E88E5] to-[#42A5F5] hover:from-[#1565C0] hover:to-[#1E88E5] text-white py-4 rounded-xl font-semibold shadow-xl shadow-blue-300 transition-all duration-300 hover:scale-105 text-base sm:text-lg">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function bukaModal(el) {
            const modal = document.getElementById('detailModal');
            document.getElementById('modalJudul').innerText = el.getAttribute('data-judul');
            document.getElementById('modalKategori').innerText = el.getAttribute('data-kategori');
            document.getElementById('modalDesc').innerText = el.getAttribute('data-desc');
            document.getElementById('modalAuthor').innerText = el.getAttribute('data-author');
            document.getElementById('modalDate').innerText = el.getAttribute('data-date');
            document.getElementById('modalImg').src = 'uploads/' + el.getAttribute('data-img');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function tutupModal() { 
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') { tutupModal(); }
        });
    </script>
</body>
</html>