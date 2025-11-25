<?php
$saldo = $_POST['saldo_awal'];
$n = $_POST['bulan'];

for ($i = 1; $i <= $n; $i++) {
    if ($saldo < 1100000) {
        $bunga = $saldo * 0.03;
    } else {
        $bunga = $saldo * 0.04;
    }

    $saldo = $saldo + $bunga - 9000;
}

echo "Saldo akhir setelah $n bulan adalah: Rp " . number_format($saldo, 0, ',', '.');
?>

