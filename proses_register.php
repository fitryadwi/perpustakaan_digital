<?php

include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $role = "user";

    if (strlen($password) < 8) {
        echo "Password harus memiliki minimal 8 karakter.";
    } else {
        $sql = "INSERT INTO user (username,password,email,nama_lengkap,alamat,role)values('$username','$password','$email','$nama_lengkap','$alamat','$role')";

        if ($connect->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
    }
}
$connect->close();
?>
