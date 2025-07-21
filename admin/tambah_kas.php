<?php
include '../backend/config/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_nik = mysqli_real_escape_string($connect, $_POST['id_nik']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);

    $fields = "id_nik,keterangan";
    $values = "'$id_nik','$keterangan'";

    for ($i=1; $i<=12; $i++) {
        $bln = isset($_POST["bln_$i"]) ? intval($_POST["bln_$i"]) : 0;
        $fields .= ",bln_$i";
        $values .= ",'$bln'";
    }

    $sql = "INSERT INTO kas ($fields) VALUES ($values)";
    mysqli_query($connect, $sql);
}

header("Location: data_kas.php");
exit;
?>
