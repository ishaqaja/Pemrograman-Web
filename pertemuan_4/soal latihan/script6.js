console.log("Script Praktikum Dijalankan");

// Variabel untuk menangkap elemen dari HTML
const elNama = document.getElementById("nama-mhs");
const elNilai = document.getElementById("nilai-mhs");
const elStatus = document.getElementById("status-kelulusan");

// Mengambil input elemen
const inputNama = document.getElementById("input-nama");
const inputNilai = document.getElementById("input-nilai");

// Menangani klik tombol submit
document.getElementById("submit-btn").addEventListener("click", function () {
  // Mendapatkan nilai input dari pengguna
  const namaMahasiswa = inputNama.value;
  const nilai = parseInt(inputNilai.value);

  // Menampilkan Nama dan Nilai
  elNama.textContent = namaMahasiswa;
  elNilai.textContent = nilai;

  // Logika Kelulusan (if..else)
  let pesanStatus;
  let isLulus;

  if (nilai >= 75) {
    pesanStatus = "Selamat, Anda Dinyatakan LULUS!";
    isLulus = true;
  } else {
    pesanStatus = "Tetap Semangat, Anda HARUS Mengulang.";
    isLulus = false;
  }

  // Menampilkan status kelulusan
  elStatus.textContent = pesanStatus;

  // Mengubah gaya berdasarkan status kelulusan
  if (isLulus === true) {
    elStatus.style.color = "green";
    elStatus.style.fontWeight = "bold";
  } else {
    elStatus.style.color = "red";
    elStatus.style.fontWeight = "bold";
  }
});
