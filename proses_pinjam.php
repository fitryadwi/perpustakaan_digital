<?php
include('koneksi.php');
session_start();
if (isset($_GET['buku_id'])) {
    $id = $_GET['buku_id'];

    $user_id = $_SESSION['user']['user_id'];
    $tanggal_peminjaman = date('Y-m-d'); 
    $buku_id = $id; 
    $tanggal_pengembalian = date('Y-m-d', strtotime($tanggal_peminjaman . ' +3 day'));
    $status_peminjaman = 'Pending';

    $query = "INSERT INTO peminjaman (user_id, buku_id, tanggal_peminjaman, tanggal_pengembalian, status_peminjaman) VALUES ('$user_id', '$buku_id', '$tanggal_peminjaman', '$tanggal_pengembalian', '$status_peminjaman')";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: user_pinjam.php");
        exit();
    } else {
        echo "Gagal melakukan peminjaman.";
    }
}
?>
