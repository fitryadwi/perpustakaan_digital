<?php
//panggil file config.php untuk menghubung ke server
include('koneksi.php'); //memanggil file koneksi.php untuk terhubung ke database

//tangkap data dari form
$email = $_POST['email']; //menangkap dari form username
$password =md5 ($_POST['password']); //menangkap dari form password

//simpan data ke database JIKA data sudah terisi semua
$query = mysqli_query ($connect,"update user set password='$password' where email='$email'");
if($query ) {
    
    header('location:index.html');

}else{ //jika statement if tidak terpenuhi statement else berjalan
    
    header('location:login.html?');

}
?>