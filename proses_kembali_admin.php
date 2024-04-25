<?php
include('koneksi.php');
session_start();

if (isset($_GET['peminjaman_id']) && isset($_GET['action'])) {
    $id = $_GET['peminjaman_id'];
    $action = $_GET['action'];
    
    if($action === 'terima') {
        $status_peminjaman = 'Kembalikan';
    } elseif ($action === 'tolak') {
        $status_peminjaman = 'Ditolak';
    }

    $query = "UPDATE peminjaman SET status_peminjaman = '$status_peminjaman' WHERE peminjaman_id = $id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: pengembalian_admin.php");
        exit();
    } else {
        echo "Gagal melakukan pembaruan status peminjaman.";
    }
}
?>
