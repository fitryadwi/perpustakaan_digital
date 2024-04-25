<?php
session_start();
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'petugas')) {
    header("Location: login.php");
    exit();
}

include('koneksi.php');

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

    <title>Perpustakaan Digital - History</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
                <h1 class="h3 mb-0 text-gray-800">Transaksi Peminjaman</h1>
            </div>
            <form method="post" action="proses_generate.php">
                <label for="bulan">Pilih Bulan:</label>
                <input type="month" id="bulan" name="bulan" required>
                
                <label for="status">Pilih Status Peminjaman:</label>
                <select id="status" name="status" required>
                    <option value="semua">Semua</option>
                    <option value="Pending">Pending</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Kembalikan">Kembalikan</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
                
                <button type="submit" class="btn btn-success mb-3">Generate Laporan</button>
            </form>

            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Buku</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nama Buku</th>
                                    <th>Kategori Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                   $nomor = 1;
                                   $query = "SELECT peminjaman.*, user.*, buku.*,kategoribuku.nama_kategori
                                   FROM peminjaman 
                                   INNER JOIN user ON peminjaman.user_id = user.user_id 
                                   INNER JOIN buku ON peminjaman.buku_id = buku.buku_id
                                   INNER JOIN kategoribuku ON buku.kategori_id = kategoribuku.kategori_id
                                   LIMIT $offset, $items_per_page";
                                   $result = mysqli_query($connect, $query);
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $nomor++; ?></td>
                                    <td><?php echo $row['no_buku']; ?></td>
                                    <td><?php echo $row['nama_lengkap']; ?></td>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo $row['nama_kategori']; ?></td>
                                    <td><?php echo $row['tanggal_peminjaman']; ?></td>
                                    <td><?php echo $row['tanggal_pengembalian']; ?></td>
                                    <td><?php echo $row['status_peminjaman']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <?php
                            $total_pages_query = "SELECT COUNT(*) FROM peminjaman";
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
