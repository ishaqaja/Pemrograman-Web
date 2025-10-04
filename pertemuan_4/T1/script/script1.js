// Ambil elemen
const tombol = document.getElementById("btn");
const teks = document.getElementById("teks");

// Event klik tombol
tombol.addEventListener("click", function () {
  teks.textContent = "Teks berhasil diubah dengan JavaScript!";
  teks.style.color = "green";
});
