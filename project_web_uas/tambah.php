<?php
session_start();

# [CEK LOGIN KETAT]
# "Eh, kamu siapa? Udah login belum?"
# Kalau tiket (session) statusnya bukan 'login', tendang balik ke halaman depan!
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mading - CampusWall</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6 flex items-center justify-center bg-gray-50 bg-[url('assets/whitediamond.png')] bg-repeat bg-fixed min-h-screen">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Pasang Info Baru</h2>
            <a href="beranda.php" class="text-blue-600 hover:underline font-bold">← Kembali</a>
        </div>

        <!-- # [FORMULIR MULTIPART] -->
        <!-- # Penting: Atribut 'enctype' wajib ada kalau mau upload file/gambar. -->
        <!-- # Data dikirim ke 'proses.php' dengan metode POST. -->
        <form action="proses.php" method="POST" enctype="multipart/form-data">
            
            <!-- # [INPUT JUDUL] -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Judul Informasi</label>
                <input type="text" name="judul" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    placeholder="Contoh: Lomba Coding Nasional 2025">
            </div>

            <!-- # [PILIHAN KATEGORI] -->
            <!-- # Pakai Dropdown (Select) biar user gak asal isi kategori aneh-aneh. -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Akademik">Akademik</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Event">Event / Acara</option>
                    <option value="Lomba">Lomba</option>
                    <option value="Beasiswa">Beasiswa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- # [INPUT DESKRIPSI] -->
            <!-- # Pakai Textarea biar bisa nulis panjang lebar. -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi Lengkap</label>
                <textarea name="deskripsi" rows="4" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Tulis detail acara, tanggal, tempat, dll..."></textarea>
            </div>

            <!-- # [UPLOAD GAMBAR] -->
            <!-- # Atribut 'accept' membatasi file explorer biar cuma nunjukin gambar (JPG/PNG). -->
            <!-- # Ini UX yang bagus biar user gak salah upload file PDF atau Word. -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Poster / Gambar (Wajib)</label>
                <input type="file" name="foto" required accept=".jpg, .jpeg, .png"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="text-xs text-gray-400 mt-1">Format: JPG/PNG.</p>
            </div>

            <!-- # [TOMBOL SUBMIT] -->
            <button type="submit" name="btn_simpan" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition duration-200">
                Terbitkan Mading
            </button>

        </form>
    </div>

</body>
</html>