<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit();
}

$items_per_page = 10;
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$offset = ($current_page - 1) * $items_per_page;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Perpustakaan Digital - User Pinjam</title>

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
        height: 150px; /* Sesuaikan dengan kebutuhan */
        width: 100%;
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
</style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

            <?php
            include 'sidebar_user.php';
            ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nomber Buku</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Penulis</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                    include('koneksi.php');
                                    $nomor = 1;
                                
                                    $query = "SELECT peminjaman.*, user.*, buku.*,kategoribuku.nama_kategori
                                    FROM peminjaman 
                                    INNER JOIN user ON peminjaman.user_id = user.user_id 
                                    INNER JOIN buku ON peminjaman.buku_id = buku.buku_id
                                    INNER JOIN kategoribuku ON buku.kategori_id = kategoribuku.kategori_id
                                    WHERE peminjaman.user_id = '{$_SESSION['user']['user_id']}'
                                    AND (peminjaman.status_peminjaman = 'Pending' OR peminjaman.status_peminjaman = 'Dipinjam' OR peminjaman.status_peminjaman = 'Kembali')";
                                    $result = mysqli_query($connect, $query);
                                    while ($row = mysqli_fetch_assoc($result)) { 
                                        ?>
                                        <tr>
                                            <td><?php echo $nomor++; ?></td>
                                            <td><img src="./upload/<?php echo $row['gambar']; ?>" height="50" width="50" ></td>
                                            <td><?php echo $row['no_buku']; ?></td>
                                            <td><?php echo $row['judul']; ?></td>
                                            <td><?php echo $row['nama_kategori']; ?></td>
                                            <td><?php echo $row['penulis']; ?></td>
                                            <td><?php echo $row['penerbit']; ?></td>
                                            <td><?php echo $row['tahun_terbit']; ?></td>
                                            <td><?php echo $row['tanggal_peminjaman']; ?></td>
                                            <td><?php echo $row['tanggal_pengembalian']; ?></td>
                                            <td>
                                                <?php
                                                $status_peminjaman = $row['status_peminjaman'];
                                                if ($status_peminjaman == "Pending") {
                                                    echo '<p>Proses Pinjam</p>';
                                                } elseif($status_peminjaman == "Dipinjam") {
                                                    echo '<a type="button" class="btn btn-primary" href="proses_kembali_user.php?peminjaman_id=' . $row['peminjaman_id'] . '">Kembalikan</a>';
                                                }elseif($status_peminjaman == "Kembali") {
                                                    echo '<p>Proses Pengembalian</p>';
                                                }
                                                ?>
                                            <!-- <a type="button" class="btn btn-success" href="">Kembalikan</a> -->
                                        </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                            $total_pages_query = "SELECT COUNT(*) AS total FROM peminjaman 
                            INNER JOIN user ON peminjaman.user_id = user.user_id 
                            INNER JOIN buku ON peminjaman.buku_id = buku.buku_id
                            INNER JOIN kategoribuku ON buku.kategori_id = kategoribuku.kategori_id
                            WHERE peminjaman.user_id = '{$_SESSION['user']['user_id']}'
                            AND (peminjaman.status_peminjaman = 'Pending' OR peminjaman.status_peminjaman = 'Terima' OR peminjaman.status_peminjaman = 'Kembali')";
                            $result = mysqli_query($connect, $total_pages_query);
                            $total_rows = mysqli_fetch_array($result)[0];
                            $total_pages = ceil($total_rows / $items_per_page);
                            if ($current_page > 1) {
                                $prev = $current_page - 1;
                                echo "<li class='page-item'><a class='page-link' href='?page=$prev'>Previous</a></li>";
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
                            }
                            if ($current_page < $total_pages) {
                                $next = $current_page + 1;
                                echo "<li class='page-item'><a class='page-link' href='?page=$next'>Next</a></li>";
                            }
                            ?>
                        </ul>
                    </nav>
                        </div>
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

</body>

</html>