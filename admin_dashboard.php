<?php
session_start();

if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'petugas')) {
    header("Location: login.php");
    exit();
}
include('koneksi.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan Digital - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
.center {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 200px;
}

.center i {
    position: absolute;
    bottom: 0;
    font-size: 3em;

}

    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
        include 'sidebar_admin.php';
        ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                    <?php
                    $query = "SELECT COUNT(*) AS total FROM buku";
                    $result = mysqli_query($connect, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_buku = $row['total'];
                    ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Data Buku</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_buku; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                    $query = "SELECT COUNT(*) AS total FROM user";
                    $result = mysqli_query($connect, $query);
                    $row = mysqli_fetch_assoc($result);
                    $total_user = $row['total'];
                    ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_user; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $query = "SELECT COUNT(*) AS total FROM peminjaman WHERE status_peminjaman ='Terima'";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_assoc($result);
                        $total_peminjaman = $row['total'];
                        ?>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Dipinjam</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_peminjaman; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-address-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $query = "SELECT COUNT(*) AS total FROM peminjaman WHERE status_peminjaman ='Kembalikan'";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_assoc($result);
                        $total_kembali = $row['total'];
                        ?>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Dikembalikan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_kembali; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-reply-all fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        </div class="center">
                        <img src="img/buku-logo.png" alt="" class="center" style="display: block; margin: 0 auto;">
                        <!-- <i class="fa fa-book fa-5x center" style="color: blue;"></i> -->
                        <h2 class="text-center" style="margin-top: 1px;">Digital Library</h2>
                        <p class="text-center">
                            Alamat : JL. Ujung Berung No. 27 | Email : contact@digitalperpus.com | Nomor Telpon : 085759143043</p>
                    </div>

                    </div>
               
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
          


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