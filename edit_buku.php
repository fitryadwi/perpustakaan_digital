<?php
session_start();

include('koneksi.php');

if (isset($_GET['buku_id'])) {
    $id = $_GET['buku_id'];

    $query = "SELECT * FROM buku WHERE buku_id=$id";
    $result = mysqli_query($connect, $query);

    $row = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan Digital - Edit Buku</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
             <div id="wrapper">

                <?php
                include 'sidebar_admin.php';
                ?>
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit buku</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                        <form class="row g-3" action="proses_edit_buku.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['buku_id']; ?>">
                                <div class="col-md-6">
                                    <label lass="form-label">Judul</label>
                                    <input type="text" class="form-control" name="judul" value="<?php echo $row['judul']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Penulis</label>
                                    <input type="text" class="form-control" name="penulis" value="<?php echo $row['penulis']; ?> ">
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label">Penerbit</label>
                                    <input type="text" class="form-control" name="penerbit" value="<?php echo $row['penerbit']; ?> ">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="data_buku.php" class="btn btn-danger">Batal</a>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <?php
            include 'footer.php';
            ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


            
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>