<?php
include '../backend/config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_kas = mysqli_real_escape_string($connect, $_POST['id_kas']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);

    $update_fields = [];
    for ($i=1; $i<=12; $i++) {
        $bln = isset($_POST["bln_$i"]) ? intval($_POST["bln_$i"]) : 0;
        $update_fields[] = "bln_$i='$bln'";
    }
    $update_fields[] = "keterangan='$keterangan'";

    $sql = "UPDATE kas SET ".implode(",", $update_fields)." WHERE id_kas='$id_kas'";
    mysqli_query($connect, $sql);
}

header("Location: data_kas.php");
exit;
?>
