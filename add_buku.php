<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_buku = $_POST['no_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $kategori_id = $_POST['kategori'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $filename = $_FILES["gambar"]["name"];
    $tempname = $_FILES["gambar"]["tmp_name"];
    $folder = "./upload/" . $filename;

    $query = "INSERT INTO buku (no_buku,judul, penulis, penerbit, kategori_id ,tahun_terbit, gambar) VALUES ('$no_buku','$judul', '$penulis', '$penerbit', $kategori_id, '$tahun_terbit', '$filename')";

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }

    if (mysqli_query($connect, $query)) {
        header("Location: data_buku.php");
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connect);
    }
}
?>
