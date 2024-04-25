<?php

include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $user_id = $_SESSION['user']['user_id'];
    $buku_id = $_POST['id'];
    $ulasan = $_POST['ulasan'];
    $rating = $_POST['rating'];

        $sql = "INSERT INTO ulasanbuku (user_id, buku_id, ulasan ,rating) VALUES ('$user_id', '$buku_id','$ulasan','$rating')";

        if ($connect->query($sql) === TRUE) {
            header("Location: user_kembali.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
}
$connect->close();
?>
