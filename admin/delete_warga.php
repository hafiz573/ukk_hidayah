<?php
include '../backend/config/connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $connect->query("DELETE FROM warga WHERE id_nik='$id'");
}

header("Location: data_warga.php");
?>