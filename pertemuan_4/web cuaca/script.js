const dataCuaca = {
  Jakarta: {
    suhu: "32°C",
    deskripsi: "Cerah Terik",
    ikon: "https://cdn-icons-png.flaticon.com/512/869/869869.png",
  },
  Bandung: {
    suhu: "24°C",
    deskripsi: "Mendung",
    ikon: "https://cdn-icons-png.flaticon.com/512/414/414825.png",
  },
  Surabaya: {
    suhu: "34°C",
    deskripsi: "Panas Terik",
    ikon: "https://cdn-icons-png.flaticon.com/512/869/869869.png",
  },
  Medan: {
    suhu: "30°C",
    deskripsi: "Hujan Ringan",
    ikon: "https://cdn-icons-png.flaticon.com/512/1146/1146869.png",
  },
  Yogyakarta: {
    suhu: "28°C",
    deskripsi: "Berawan",
    ikon: "https://cdn-icons-png.flaticon.com/512/1163/1163661.png",
  },
  Bali: {
    suhu: "31°C",
    deskripsi: "Cerah Berawan",
    ikon: "https://cdn-icons-png.flaticon.com/512/1163/1163624.png",
  },
  Makassar: {
    suhu: "29°C",
    deskripsi: "Hujan Petir",
    ikon: "https://cdn-icons-png.flaticon.com/512/1146/1146860.png",
  },
  Palembang: {
    suhu: "30°C",
    deskripsi: "Gerimis",
    ikon: "https://cdn-icons-png.flaticon.com/512/4150/4150897.png",
  },
  Semarang: {
    suhu: "27°C",
    deskripsi: "Cerah",
    ikon: "https://cdn-icons-png.flaticon.com/512/869/869869.png",
  },
  Malang: {
    suhu: "25°C",
    deskripsi: "Mendung Tebal",
    ikon: "https://cdn-icons-png.flaticon.com/512/414/414825.png",
  },
};

document.getElementById("cuacaForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const kota = document.getElementById("kota").value;
  const hasil = document.getElementById("hasil");
  const namaKota = document.getElementById("namaKota");
  const deskripsi = document.getElementById("deskripsi");
  const suhu = document.getElementById("suhu");
  const ikonCuaca = document.getElementById("ikonCuaca");

  if (kota && dataCuaca[kota]) {
    const cuaca = dataCuaca[kota];

    namaKota.textContent = `🌍 ${kota}`;
    deskripsi.textContent = cuaca.deskripsi;
    suhu.textContent = cuaca.suhu;
    ikonCuaca.src = cuaca.ikon;

    hasil.classList.remove("hidden");

    console.log(`Kota: ${kota}`);
    console.log(`Deskripsi: ${cuaca.deskripsi}`);
    console.log(`Suhu: ${cuaca.suhu}`);
  } else {
    alert("Silakan pilih kota terlebih dahulu!");
  }
});
