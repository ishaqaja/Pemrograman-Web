// Data dummy cuaca untuk 10 kota
const dataCuaca = {
  Jakarta: { suhu: "30°C", kondisi: "Cerah" },
  Bandung: { suhu: "24°C", kondisi: "Hujan Ringan" },
  Surabaya: { suhu: "32°C", kondisi: "Panas" },
  Medan: { suhu: "29°C", kondisi: "Berawan" },
  Yogyakarta: { suhu: "27°C", kondisi: "Mendung" },
  Semarang: { suhu: "31°C", kondisi: "Gerimis" },
  Denpasar: { suhu: "28°C", kondisi: "Cerah Berawan" },
  Makassar: { suhu: "30°C", kondisi: "Hujan Deras" },
  Balikpapan: { suhu: "29°C", kondisi: "Berawan" },
  Palembang: { suhu: "31°C", kondisi: "Panas Terik" },
};

document
  .getElementById("form-cuaca")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const kota = document.getElementById("kota").value;
    const hasilDiv = document.getElementById("hasil");

    if (dataCuaca[kota]) {
      const cuaca = dataCuaca[kota];
      hasilDiv.innerHTML = `<p><strong>${kota}</strong> : ${cuaca.suhu}, ${cuaca.kondisi}</p>`;
      console.log(
        `Cuaca di ${kota}: Suhu ${cuaca.suhu}, Kondisi ${cuaca.kondisi}`
      );
    } else {
      hasilDiv.innerHTML = `<p>Data cuaca untuk <strong>${kota}</strong> tidak ditemukan.</p>`;
      console.log(`Data cuaca untuk ${kota} tidak ditemukan.`);
    }
  });
