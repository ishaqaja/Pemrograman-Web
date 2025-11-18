<?php
if (isset($_POST['tahun'])) {
    $tahun = (int)$_POST['tahun'];

    if (($tahun % 400 == 0) || ($tahun % 4 == 0 && $tahun % 100 != 0)) {
        $hasil = "Tahun $tahun adalah tahun kabisat.";
    } else {
        $hasil = "Tahun $tahun bukan tahun kabisat.";
    }
} else {
    $hasil = "Tidak ada tahun yang dimasukkan.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Cek Tahun Kabisat</title>
</head>
<body>

<h2>Hasil</h2>
<p><?php echo $hasil; ?></p>

</body>
</html>
