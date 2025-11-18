<?php
// Ambil bulan saat ini (angka 1–12)
$bulan = date("n");

switch ($bulan) {
    case 1:
        $nama = "Januari";
        $hari = 31;
        break;

    case 2:
        $nama = "Februari";
        // Cek kabisat
        $tahun = date("Y");
        if (($tahun % 400 == 0) || ($tahun % 4 == 0 && $tahun % 100 != 0)) {
            $hari = 29;
        } else {
            $hari = 28;
        }
        break;

    case 3:
        $nama = "Maret";
        $hari = 31;
        break;

    case 4:
        $nama = "April";
        $hari = 30;
        break;

    case 5:
        $nama = "Mei";
        $hari = 31;
        break;

    case 6:
        $nama = "Juni";
        $hari = 30;
        break;

    case 7:
        $nama = "Juli";
        $hari = 31;
        break;

    case 8:
        $nama = "Agustus";
        $hari = 31;
        break;

    case 9:
        $nama = "September";
        $hari = 30;
        break;

    case 10:
        $nama = "Oktober";
        $hari = 31;
        break;

    case 11:
        $nama = "November";
        $hari = 30;
        break;

    case 12:
        $nama = "Desember";
        $hari = 31;
        break;

    default:
        $nama = "Tidak diketahui";
        $hari = 0;
        break;
}

echo "Bulan saat ini adalah $nama dan memiliki $hari hari.";
?>
