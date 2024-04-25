<?php
include('koneksi.php');

if (isset($_GET['buku_id'])) {
    $id = $_GET['buku_id'];

    $query = "DELETE FROM buku WHERE buku_id=$id";

    if (mysqli_query($connect, $query)) {
        header("Location: data_buku.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}
?>
