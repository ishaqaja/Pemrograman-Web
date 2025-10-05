// Fungsi untuk ubah teks & style
function ubahKonten() {
  const judul = document.getElementById("judul");
  const paragraf = document.getElementById("paragraf");

  judul.textContent = "Judul Baru";
  paragraf.textContent = "Paragraf ini juga berubah setelah klik tombol.";

  judul.style.color = "red";
  judul.style.fontSize = "24px";
  judul.style.fontWeight = "bold";

  paragraf.style.color = "blue";
  paragraf.style.fontStyle = "italic";

  console.log("Konten berhasil diubah!");
}

// Fungsi reset kembali ke awal
function resetKonten() {
  const judul = document.getElementById("judul");
  const paragraf = document.getElementById("paragraf");

  judul.textContent = "Judul Asli";
  paragraf.textContent = "Ini adalah teks awal paragraf.";

  judul.style.color = "black";
  judul.style.fontSize = "20px";
  judul.style.fontWeight = "normal";

  paragraf.style.color = "black";
  paragraf.style.fontStyle = "normal";

  console.log("Konten sudah direset!");
}
