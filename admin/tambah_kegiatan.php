<?php
include '../backend/config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_kegiatan = mysqli_real_escape_string($connect, $_POST['item_kegiatan']);
    $pendapatan = intval($_POST['pendapatan']);
    $pengeluaran = intval($_POST['pengeluaran']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $tanggal = mysqli_real_escape_string($connect, $_POST['tanggal']);

    // Hitung saldo_akhir (ambil saldo terakhir, lalu +pendapatan -pengeluaran)
    $saldo_akhir = 0;
    $q = mysqli_query($connect, "SELECT saldo_akhir FROM keuangan_rt ORDER BY id_kas DESC LIMIT 1");
    if ($q && $row = mysqli_fetch_assoc($q)) {
        $saldo_akhir = $row['saldo_akhir'];
    }
    $saldo_akhir = $saldo_akhir + $pendapatan - $pengeluaran;

    $sql = "INSERT INTO keuangan_rt (item_kegiatan, pendapatan, pengeluaran, saldo_akhir, keterangan, tanggal)
            VALUES ('$item_kegiatan', '$pendapatan', '$pengeluaran', '$saldo_akhir', '$keterangan', '$tanggal')";
    mysqli_query($connect, $sql);
}

header("Location: keuangan_rt.php");
exit;
?>
