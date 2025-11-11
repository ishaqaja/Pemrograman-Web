<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hitung Saldo Akhir</title>
</head>
<body>
    <h2>Hitung Saldo Akhir Tabungan</h2>
    <form method="POST" action="">
        <label>Saldo Awal (Rp): </label>
        <input type="number" name="saldo_awal" required><br><br>

        <label>Bunga per Bulan (%): </label>
        <input type="number" step="0.01" name="bunga" required><br><br>

        <label>Lama (bulan): </label>
        <input type="number" name="bulan" required><br><br>

        <input type="submit" name="submit" value="Hitung">
        <input type="reset" value="Reset">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $saldoAwal = $_POST['saldo_awal'];
        $bunga = $_POST['bunga'] / 100; // ubah persen ke desimal
        $bulan = $_POST['bulan'];

        // Rumus bunga majemuk
        $saldoAkhir = $saldoAwal * pow((1 + $bunga), $bulan);

        echo "<h3>Hasil Perhitungan:</h3>";
        echo "Saldo Awal: Rp " . number_format($saldoAwal, 0, ',', '.') . "<br>";
        echo "Bunga per Bulan: " . $_POST['bunga'] . "%<br>";
        echo "Lama: " . $bulan . " bulan<br><br>";
        echo "<strong>Saldo Akhir setelah $bulan bulan adalah: Rp " . number_format($saldoAkhir, 0, ',', '.') . "</strong>";
    }
    ?>
</body>
</html>
