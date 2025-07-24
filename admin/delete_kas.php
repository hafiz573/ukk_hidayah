<?php
include '../backend/config/connect.php';

if (isset($_GET['id'])) {
    $id_kas = mysqli_real_escape_string($connect, $_GET['id']);
    mysqli_query($connect, "DELETE FROM kas WHERE id_kas='$id_kas' LIMIT 1");
}

header("Location: data_kas.php");
exit;
?>