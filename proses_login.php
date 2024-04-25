<?php
session_start();
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($connect,$_POST['username']);
    $password = mysqli_real_escape_string($connect,$_POST['password']);

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            if ($user['role'] == 'admin') {
                header('Location: admin_dashboard.php');
            } elseif ($user['role'] == 'petugas') {
                header('Location: admin_dashboard.php');
            } elseif ($user['role'] == 'user') {
                header('Location: user_dashboard.php');
            }
        } else {
            $_SESSION['login_error'] = " password salah.";
        header("Location: login.php");
        exit();
        }
    } else {
        $_SESSION['login_error'] = "Username tidak ditemukan";
        header("Location: login.php");
        exit();
    }
}

?>