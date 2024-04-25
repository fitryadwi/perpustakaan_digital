<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "perpustakaan_digital";

$connect = mysqli_connect($host, $username, $password, $database);

if ($connect->connect_error) {
    die("Koneksi gagal: " . $connect->connect_error);
}
?>