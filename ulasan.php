<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan Digital - Ulasan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-img-top {
            flex-shrink: 0;
            object-fit: cover;
            height: 150px;
            /* Sesuaikan dengan kebutuhan */
            width: 100%;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
    </style>
    <style>
        .yellow-star {
            color: gold;
            /* Warna kuning */
        }
    </style>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php
        $user_role = $_SESSION['user']['role']; 
        if ($user_role == "admin" || $user_role == "petugas") {
            include 'sidebar_admin.php';
        } else {
            include 'sidebar_user.php';
        }
        ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php
                        function generateStars($rating) {
                            $stars = '';
                            for ($i = 0; $i < $rating; $i++) {
                                $stars .= '<span class="yellow-star">&#9733;</span>';
                            }
                            return $stars;
                        }
                    include('koneksi.php');
                    if (isset($_GET['buku_id']) && !empty($_GET['buku_id'])) {
                        $target_buku_id = $_GET['buku_id'];
                        $query = "SELECT ulasanbuku.*, user.*, buku.*
                        FROM ulasanbuku
                        INNER JOIN user ON ulasanbuku.user_id = user.user_id
                        INNER JOIN buku ON ulasanbuku.buku_id = buku.buku_id
                        WHERE ulasanbuku.buku_id = $target_buku_id";
                           
                    $query_run = mysqli_query($connect, $query);
                    if (mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $row) {
                        ?>
                        <div class="col mb-3" style="max-width: 200px;">
                            <div class="card" style="width: 100%;">
                                <img src="./upload/<?php echo $row['gambar']; ?>" class="card-img-top" alt="..."
                                    style="max-height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h5> <?php echo $row['judul']; ?> </h5>
                                    <h6> Diulas oleh : <?php echo $row['nama_lengkap']; ?> </h6>
                                    <h5 class="card-title text-center" style="font-size: 14px;">
                                        <?php echo $row['ulasan']; ?> <br>
                                        <?php echo generateStars($row['rating']); ?>
                                    </h5>

                                </div>
                            </div>
                        </div>
                        <?php
                        }   
                    }else{
                        echo "Belum ada ulasan";
                    }
                    
        } else {
            echo "Belum ada ulasan";
        }
        ?>
                    </div>
                </div>

                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

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
    <!-- Letakkan JavaScript di bagian bawah sebelum tag penutup body -->
    <!-- Script JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var detailButtons = document.querySelectorAll('.btn-detail');
            detailButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var targetModalId = this.getAttribute('data-bs-target');
                    var modal = new bootstrap.Modal(document.querySelector(targetModalId));
                    modal.show();
                });
            });
        });
    </script>


</body>

</html>