<?php
session_start();

include '../backend/config/connect.php'; // koneksi $connect
// $query = new Database();

if (!isset($_SESSION['loggedin']) or $_SESSION['loggedin'] !== true) {
    header("Location: ../login.php");
    exit;
}
