<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pendaftaran</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $tempat = $_POST['tempat_lahir'];
    $tgl = $_POST['tgl'];
    $bln = $_POST['bln'];
    $thn = $_POST['thn'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jk'];
    $asal = $_POST['asal_sekolah'];
    $nilai = $_POST['nilai_uan'];

    echo "<h3>Terima kasih <b>$nama</b> sudah mengisi form pendaftaran.</h3>";
    echo "Nama Lengkap : $nama<br>";
    echo "Tempat Lahir : $tempat<br>";
    echo "Tanggal Lahir : $tgl-$bln-$thn<br>";
    echo "Alamat Rumah : $alamat<br>";
    echo "Jenis Kelamin : $jk<br>";
    echo "Asal Sekolah : $asal<br>";
    echo "Nilai UAN : $nilai<br>";
}
?>
</body>
</html>
