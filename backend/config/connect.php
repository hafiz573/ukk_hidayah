<?php
$host = 'localhost';
$dbname = 'ukk_hidayah';
$username = 'root';
$password = '';

$connect = mysqli_connect($host, $username, $password, $dbname);

if (!$connect) {
    die('gagal bos'. mysqli_connect_error());
}