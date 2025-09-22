# Profile Instagram

Proyek ini membuat tapilan halaman profile website dengan **HTML**, framework **Tailwind CSS**, dan **Bootstrap 5**.

---

## Cara Kerja Tailwind & Bootstrap via CDN

### Bootstrap CSS

```html
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>
```

- Framework CSS dengan kumpulan komponen siap pakai.
- Menyediakan grid system, komponen UI, dan utility class bawaan.
- Baik untuk membuat tampilan dengan cepat hingga aplikasi berskala besar.

---

### Tailwind CSS

```html
<script src="https://cdn.tailwindcss.com"></script>
```

- Mengambil class utility langsung dari file HTML.
- Mekanisme Just-in-Time (JIT) memastikan hanya class yang dipakai yang akan dimuat.
- Hasil CSS disisipkan otomatis ke <head>.
- Cocok untuk belajar & prototyping.

---

## Penjelasan Fitur Bootstrap (Instagram Dark Profile)

Proyek ini menggunakan **Bootstrap 5** dengan tambahan CSS custom untuk membuat tampilan mirip profil Instagram versi dark mode.

### Fitur Utama

- **Grid System** → Membagi halaman dengan `row` dan `col-*` agar layout responsif.
- **Komponen Bootstrap** → Navigasi, tab, tombol, ikon (via Bootstrap Icons).
- **Utility Classes** → Styling cepat seperti margin, padding, teks, dan flexbox.
- **Custom CSS** → Menambahkan gaya khusus (sidebar, highlight, postingan).
- **Responsif** → Sidebar otomatis disembunyikan pada layar kecil.

---

### 1. Layout & Struktur

- `container-fluid` → Membungkus seluruh halaman dengan lebar penuh.
- `row` + `col-*` → Membagi sidebar dan konten utama.
- `content-wrapper` (CSS custom) → Membatasi lebar maksimal konten agar tetap rapi di tengah.

---

### 2. Sidebar

- `col-2` + `border-end` → Sidebar kecil di sisi kiri dengan garis pemisah.
- `nav flex-column` → Menu navigasi vertikal.
- Ikon diambil dari **Bootstrap Icons** (`bi-house`, `bi-search`, dll).
- CSS tambahan untuk hover (`.nav-link:hover`) agar lebih interaktif.

---

### 3. Bagian Profil

- **Foto Profil**: `rounded-circle img-fluid profile-img` dengan border custom.
- **Info Pengguna**: `d-flex align-items-center flex-wrap` → username, tombol, dan ikon gear tersusun rapi.
- **Statistik**: `list-inline` untuk menampilkan jumlah kiriman, pengikut, dan diikuti.
- **Bio**: menggunakan teks tebal, normal, dan italic.

---

### 4. Highlight Stories

- **Wrapper**: `d-flex overflow-auto` → scroll horizontal di layar kecil.
- **Foto Sorotan**: `highlight-img` (CSS custom: ukuran, border, padding).
- **Story Baru**: kotak kosong dengan simbol `+` sebagai placeholder.

---

### 5. Tabs Navigasi

- `nav nav-tabs justify-content-center` → tab untuk postingan, tersimpan, dan ditandai.
- `nav-link active` → menandai tab aktif.
- CSS custom mengubah warna garis bawah dan teks tab.

---

### 6. Grid Postingan

- `row g-2` → grid dengan jarak antar item.
- `col-12 col-sm-6 col-md-4` → 1 kolom di mobile, 2 kolom di tablet, 3 kolom di desktop.
- `.post-box` (CSS custom) → menjaga rasio 1:1 (square).
- `.post-img` → gambar di-crop agar memenuhi kotak dengan border tipis.

---

### 7. Footer

- `border-top pt-3 text-center` → garis pemisah dan teks © 2025.

---

### 8. Responsiveness

- Sidebar (`.sidebar`) otomatis disembunyikan di layar ≤ 768px.
- Ukuran foto profil dan highlight story diperkecil di mobile.

---

## Teknologi yang Digunakan

- **Bootstrap 5.3.3 (via CDN)** → komponen dan grid system.
- **Bootstrap Icons** → ikon navigasi.
- **Custom CSS** → style tambahan (profile-img, highlight, post-box, tab, dll).

---

## Penjelasan Utility Class Tailwind (Instagram Dark Profile)

Proyek ini dibuat dengan **Tailwind CSS** menggunakan pendekatan utility-first. Semua styling ditulis langsung di atribut `class`.

---

### 1. Layout & Struktur Halaman

- `flex` → Layout utama memakai flexbox.
- `hidden md:flex` → Sidebar hanya tampil di layar **medium ke atas**.
- `w-48 lg:w-56` → Lebar sidebar berubah (48 di md, 56 di lg).
- `flex-1` → Konten utama mengambil sisa ruang.
- `max-w-4xl` → Konten dibatasi agar tidak terlalu melebar di layar besar.

---

### 2. Navigasi Sidebar

- `flex flex-col space-y-3` → Menu navigasi vertikal dengan jarak antar item.
- `hover:text-gray-200` → Memberi efek hover yang lebih cerah.
- `w-7 h-7 rounded-full` → Foto profil kecil berbentuk bulat di sidebar.
- `border-r border-gray-700` → Garis pemisah antara sidebar dan konten utama.

---

### 3. Bagian Profil

- `flex flex-col md:flex-row` → Susunan vertikal di mobile, horizontal di layar besar.
- `w-28 h-28 md:w-32 md:h-32` → Ukuran foto profil responsif.
- `rounded-full border-2 border-gray-700 object-cover` → Foto bulat dengan border abu gelap.
- `flex items-center flex-wrap space-x-3` → Username, tombol, dan ikon tersusun rapi.
- `px-3 py-1 border border-gray-300 text-sm rounded hover:bg-gray-800` → Styling tombol profil.

---

### 4. Statistik Profil

- `flex space-x-6 text-sm` → Data statistik berjajar dengan jarak antar item.
- `font-bold` → Angka jumlah kiriman/pengikut ditebalkan.

---

### 5. Bio

- `font-bold` → Nama ditulis tebal.
- `text-gray-400` → Menandai teks sekunder (contoh: pronoun).
- `italic` → Kutipan ditampilkan dengan gaya italic.

---

### 6. Highlight Stories

- `flex overflow-x-auto space-x-4` → Story dapat discroll horizontal di layar kecil.
- `w-16 h-16 rounded-full border-2 border-gray-700` → Bentuk story bulat dengan border.
- `bg-gray-900 flex items-center justify-center` → Story baru berbentuk lingkaran kosong dengan simbol `+`.

---

### 7. Tabs Navigasi

- `flex justify-center space-x-12 border-b border-gray-700` → Tab rata tengah dengan garis bawah.
- `pb-2 border-b-2 border-white` → Menandai tab aktif.
- `text-gray-400 hover:text-gray-200` → Warna tab non-aktif jadi lebih cerah saat hover.

---

### 8. Grid Postingan

- `grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2` → Grid responsif:
  - 1 kolom di mobile
  - 2 kolom di tablet
  - 3 kolom di desktop
- `aspect-square object-cover` → Gambar tetap berbentuk kotak dan rapi.
- `border border-gray-700` → Memberi border tipis pada gambar.

---

### 9. Footer

- `text-center mt-6 border-t border-gray-700 pt-3 text-gray-500 text-sm` → Teks © 2025 dengan gaya kecil, abu, dan garis pemisah di atas.

---

## Teknologi yang Digunakan

- **Tailwind CSS (via CDN)** → styling berbasis utility-first.
- **Font Awesome 6.5.2** → ikon navigasi (house, search, reels, dll).

---

## Responsifitas

- Tailwind menggunakan Mobile-first, class seperti `sm:`, `md:`, `lg:` untuk breakpoint.
- Bootstrap mengunakan class grid & utility responsive (`col-sm-`, `col-md-`, `d-none d-md-block`).

---

## Pertanyaan & Jawaban Bootstrap

**1. Mengapa memilih konfigurasi `col-` tertentu untuk tiap breakpoint?**

- Pemilihan ukuran `col-` di tiap breakpoint bertujuan agar jumlah kolom menyesuaikan ruang yang tersedia.
- Hal ini memastikan tata letak tetap seimbang di layar kecil maupun besar tanpa perlu styling tambahan.

**2. Bagaimana memastikan tombol Follow / Edit Profile tetap mudah dijangkau di mobile?**

- Atur tombol dengan utilitas layout seperti `d-flex` dan `flex-wrap` agar posisinya responsif.
- Tambahkan margin kecil (`mb-1`) supaya tombol tidak terlalu rapat dan mudah diakses dengan jari.

**3. Jika postingan bertambah menjadi 50, apa potensi masalah dan bagaimana mengatasinya?**

- Masalah yang mungkin muncul: halaman menjadi berat, waktu muat bertambah, serta pengalaman pengguna menurun.
- Solusi yang bisa dipakai antara lain: menerapkan **pagination**, **infinite scroll**, memanfaatkan **lazy loading** pada gambar, atau teknik optimasi grid.

---

## Pertanyaan & Jawaban Tailwind

**1. Jelaskan keputusan `grid-cols` / `gap` di tiap breakpoint — kenapa begitu?**

- Mobile dibuat 1 kolom agar konten mudah dibaca.
- Pada ukuran kecil (small) diatur 2 kolom supaya ruang lebih efisien.
- Medium naik menjadi 3 kolom untuk menampung lebih banyak elemen sekaligus tetap seimbang.
- `gap-3` dipakai agar jarak antar item konsisten dan tidak terlalu rapat.

**2. Bagaimana memanfaatkan utility responsive Tailwind untuk memecahkan masalah layout di mobile?**

- Cukup gunakan prefix responsive (`sm:`, `md:`, `lg:`, dst.) agar style otomatis menyesuaikan lebar layar.
- Dengan begitu, layout bisa tetap sederhana di mobile, lalu berubah lebih kompleks di layar yang lebih lebar tanpa perlu CSS terpisah.

**3. Trade-off antara memakai banyak utility classes vs membuat component CSS tersendiri**

- Banyak utility classes → proses pembangunan cepat, fleksibel, dan tidak perlu file CSS tambahan, tapi membuat kode HTML terlihat padat.
- Component CSS → struktur HTML lebih rapi dan mudah dibaca, cocok untuk elemen yang sering dipakai ulang, hanya saja butuh usaha ekstra menulis CSS manual.

---

## Preview

### Preview Boostrap CSS

![Boostrap Preview](assets/images/Tampilan_Boostrap.png)

### Preview Tailwind CSS

![Tailwind Preview](assets/images/Tampilan_Tailwind.png)
