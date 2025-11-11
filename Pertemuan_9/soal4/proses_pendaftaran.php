<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pendaftaran</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nama = $_GET['nama'];
    $tempat = $_GET['tempat_lahir'];
    $tgl = $_GET['tgl'];
    $bln = $_GET['bln'];
    $thn = $_GET['thn'];
    $alamat = $_GET['alamat'];
    $jk = $_GET['jk'];
    $asal = $_GET['asal_sekolah'];
    $nilai = $_GET['nilai_uan'];

    echo "<h3>Terima kasih <b>$nama</b> sudah mengisi form pendaftaran.</h3>";
    echo "Nama Lengkap : $nama<br>";
    echo "Tempat Lahir : $tempat<br>";
    echo "Tanggal Lahir : $tgl-$bln-$thn<br>";
    echo "Alamat Rumah : $alamat<br>";
    echo "Jenis Kelamin : $jk<br>";
    echo "Asal Sekolah : $asal<br>";
    echo "Nilai UAN : $nilai<br><br>";

    echo "<hr>";
    echo "<h4>Catatan:</h4>";
    echo "Data di atas dikirim menggunakan <b>method='GET'</b>, sehingga terlihat di URL seperti ini:<br>";
    echo "<code>" . htmlspecialchars($_SERVER['REQUEST_URI']) . "</code>";
}
?>
</body>
</html>
