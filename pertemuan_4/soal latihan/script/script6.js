JS;

function cekHasil() {
  const nama = document.getElementById("nama").value;
  const nilai = parseInt(document.getElementById("nilai").value);
  const output = document.getElementById("output");

  if (nama === "" || isNaN(nilai)) {
    output.textContent = "⚠ Silakan isi nama dan nilai dengan benar.";
    output.style.color = "red";
    console.log("Input tidak valid.");
    return;
  }

  // Logika penilaian
  if (nilai >= 90) {
    output.textContent = nama + ", nilai kamu " + nilai + " → Grade A 🎉";
    output.style.color = "green";
  } else if (nilai >= 75) {
    output.textContent = nama + ", nilai kamu " + nilai + " → Grade B 👍";
    output.style.color = "blue";
  } else if (nilai >= 60) {
    output.textContent = nama + ", nilai kamu " + nilai + " → Grade C 🙂";
    output.style.color = "orange";
  } else {
    output.textContent = nama + ", nilai kamu " + nilai + " → Grade D ❌";
    output.style.color = "red";
  }

  console.log("Hasil cek untuk", nama, "dengan nilai:", nilai);
}
