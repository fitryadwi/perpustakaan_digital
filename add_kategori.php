<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = $_POST['nama_kategori'];

    $query = "INSERT INTO kategoribuku (nama_kategori) VALUES ('$nama_kategori')";

    if (mysqli_query($connect, $query)) {
        header("Location: kategoribuku.php");
            exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}
?>
