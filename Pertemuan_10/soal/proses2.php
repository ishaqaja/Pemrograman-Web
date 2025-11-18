<?php
if (isset($_POST['jam'])) {
    $jam = (int)$_POST['jam'];

    $upah_normal = 2000;
    $upah_lembur = 3000;

    if ($jam <= 48) {
        $total = $jam * $upah_normal;
    } else {
        $jam_normal = 48;
        $jam_lembur = $jam - 48;

        $total = ($jam_normal * $upah_normal) + ($jam_lembur * $upah_lembur);
    }

    $hasil = "Total upah yang diterima adalah Rp. " . number_format($total, 0, ',', '.');
} else {
    $hasil = "Input tidak valid.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perhitungan Upah</title>
</head>
<body>

<h2>Hasil Perhitungan Upah</h2>
<p><?php echo $hasil; ?></p>

</body>
</html>
