<?php
include('koneksi.php');

if (isset($_GET['user_id'])) {
    $id = $_GET['user_id'];

    $query = "DELETE FROM user WHERE user_id=$id";

    if (mysqli_query($connect, $query)) {
        header("Location: user.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}
?>
