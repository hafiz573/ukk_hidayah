<?php
include '../backend/config/connect.php';

if (isset($_GET['id'])) {
    $id_kas = mysqli_real_escape_string($connect, $_GET['id']);
    mysqli_query($connect, "DELETE FROM keuangan_rt WHERE id_kas='$id_kas'");
}

header("Location: keuangan_rt.php");
exit;
?>
