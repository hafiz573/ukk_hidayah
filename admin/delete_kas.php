<?php
include '../backend/config/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kas = mysqli_real_escape_string($connect, $_POST['id_kas']);
    $id_nik = mysqli_real_escape_string($connect, $_POST['id_nik']);
    mysqli_query($connect, "DELETE FROM kas WHERE id_kas='$id_kas' AND id_nik='$id_nik' LIMIT 1");
}

header("Location: data_kas.php");
exit;
?>