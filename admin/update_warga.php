<?php
include '../backend/config/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_nik = $_POST['id_nik'];
    $nomor_kk = $_POST['nomor_kk'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $pekerjaan = $_POST['pekerjaan'];
    $status_keluarga = $_POST['status_keluarga'];

    $stmt = $connect->prepare("UPDATE warga SET nomor_kk=?, nama=?, alamat=?, pekerjaan=?, status_keluarga=? WHERE id_nik=?");
    $stmt->bind_param("ssssss", $nomor_kk, $nama, $alamat, $pekerjaan, $status_keluarga, $id_nik);
    $stmt->execute();
}

header("Location: data_warga.php");
?>