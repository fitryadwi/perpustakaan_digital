<?php

include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penerbit = $_POST['penerbit'];
    $penulis = $_POST['penulis'];
        $sql = "UPDATE buku SET judul='$judul',penerbit='$penerbit',penulis='$penulis' WHERE buku_id=$id";

        if ($connect->query($sql) === TRUE) {
            header("Location: data_buku.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
}
$connect->close();
?>
