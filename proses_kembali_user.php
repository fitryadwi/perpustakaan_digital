<?php
include('koneksi.php');
session_start();

if (isset($_GET['peminjaman_id'])) {
    $id = $_GET['peminjaman_id'];
    
    $status_peminjaman = 'Kembali';

    $query = "UPDATE peminjaman SET status_peminjaman = '$status_peminjaman' WHERE peminjaman_id = $id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: user_pinjam.php");
        exit();
    } else {
        echo "Gagal melakukan pembaruan status peminjaman.";
    }
}
?>
