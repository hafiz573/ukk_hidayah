<?php
include '../backend/config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kas = mysqli_real_escape_string($connect, $_POST['id_kas']);
    $item_kegiatan = mysqli_real_escape_string($connect, $_POST['item_kegiatan']);
    $pendapatan_dadakan = mysqli_real_escape_string($connect, $_POST['pendapatan_dadakan']);
    $pengeluaran = mysqli_real_escape_string($connect, $_POST['pengeluaran']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $tanggal = mysqli_real_escape_string($connect, $_POST['tanggal']);

    $sql = "UPDATE keuangan_rt SET 
            item_kegiatan='$item_kegiatan', 
            pendapatan_dadakan='$pendapatan_dadakan', 
            pengeluaran='$pengeluaran', 
            keterangan='$keterangan', 
            tanggal='$tanggal' 
            WHERE id_kas='$id_kas'";
    mysqli_query($connect, $sql);
}

header("Location: keuangan_rt.php");
exit;
?>
