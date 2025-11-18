<?php
if (isset($_POST['jam']) && isset($_POST['golongan'])) {

    $jam = (int)$_POST['jam'];
    $golongan = $_POST['golongan'];

    // Tentukan upah per jam berdasarkan golongan
    switch ($golongan) {
        case 'A':
            $upah_per_jam = 4000;
            break;
        case 'B':
            $upah_per_jam = 5000;
            break;
        case 'C':
            $upah_per_jam = 6000;
            break;
        case 'D':
            $upah_per_jam = 7500;
            break;
        default:
            $upah_per_jam = 0;
            break;
    }

    $upah_lembur = 3000;

    if ($jam <= 48) {
        $total = $jam * $upah_per_jam;
    } else {
        $jam_normal = 48;
        $jam_lembur = $jam - 48;

        $total = ($jam_normal * $upah_per_jam) + ($jam_lembur * $upah_lembur);
    }

    $hasil = "Total upah golongan $golongan adalah Rp. " . number_format($total, 0, ',', '.');
} else {
    $hasil = "Data tidak lengkap.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perhitungan Upah</title>
</head>
<body>

<h2>Hasil Upah Mingguan</h2>
<p><?php echo $hasil; ?></p>

</body>
</html>
