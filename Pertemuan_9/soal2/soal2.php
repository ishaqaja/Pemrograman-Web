<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hitung Pecahan Uang</title>
</head>
<body>
    <h2>Hitung Jumlah Pecahan Uang</h2>

    <form method="POST" action="">
        <label>Masukkan Jumlah Uang (Rp): </label>
        <input type="number" name="jumlahUang" required><br><br>

        <input type="submit" name="submit" value="Hitung">
        <input type="reset" value="Reset">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $jumlahUang = $_POST['jumlahUang'];

        $a = intval($jumlahUang / 100000);
        $sisa = $jumlahUang % 100000;

        $b = intval($sisa / 50000);
        $sisa = $sisa % 50000;

        $c = intval($sisa / 20000);
        $sisa = $sisa % 20000;

        $d = intval($sisa / 5000);
        $sisa = $sisa % 5000;

        $e = intval($sisa / 100);
        $sisa = $sisa % 100;

        $f = intval($sisa / 50);
        $sisa = $sisa % 50;

        echo "<h3>Hasil Perhitungan Pecahan:</h3>";
        echo "Jumlah Rp. 100.000 : " . $a . "<br>";
        echo "Jumlah Rp. 50.000 : " . $b . "<br>";
        echo "Jumlah Rp. 20.000 : " . $c . "<br>";
        echo "Jumlah Rp. 5.000 : " . $d . "<br>";
        echo "Jumlah Rp. 100 : " . $e . "<br>";
        echo "Jumlah Rp. 50 : " . $f . "<br>";
    }
    ?>
</body>
</html>
