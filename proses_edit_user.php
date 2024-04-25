<?php

include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $role = $_POST['role'];

    if (strlen($password) < 8) {
        echo "Password harus memiliki minimal 8 karakter.";
    } else {
        $sql = "UPDATE user SET nama_lengkap='$nama_lengkap',username='$username',password='$password', email='$email', alamat='$alamat', role='$role' WHERE user_id=$id";

        if ($connect->query($sql) === TRUE) {
            header("Location: user.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}
$connect->close();
?>
