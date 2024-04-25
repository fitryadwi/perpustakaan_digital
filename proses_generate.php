<?php
require_once 'koneksi.php'; 
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

function getPeminjamanByStatusAndMonth($bulan, $status) {
    global $connect;
    list($tahun, $bulan) = explode('-', $bulan); 
    $query = "SELECT peminjaman.*, user.*, buku.*,kategoribuku.nama_kategori
    FROM peminjaman 
    INNER JOIN user ON peminjaman.user_id = user.user_id 
    INNER JOIN buku ON peminjaman.buku_id = buku.buku_id
    INNER JOIN kategoribuku ON buku.kategori_id = kategoribuku.kategori_id WHERE YEAR(tanggal_peminjaman) = '$tahun' AND MONTH(tanggal_peminjaman) = '$bulan' AND (status_peminjaman = '$status' OR '$status' = 'semua')";
    $result = mysqli_query($connect, $query);
    $peminjaman = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $peminjaman[] = $row;
    }
    return $peminjaman;
}

function generateHTMLReport($bulan, $status) {
    $dompdf = new Dompdf();
    $html = "<h3>Laporan Peminjaman untuk Bulan $bulan dan Status $status</h3>";
    $html .= "<table border='1'>
                <tr>
                    <th>No</th>
                    <th>No Buku</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Buku</th>
                    <th>Kategori</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status Peminjaman</th>
                </tr>";
    $peminjaman = getPeminjamanByStatusAndMonth($bulan, $status);
    $no = 1;
    foreach ($peminjaman as $row) {
        $html .= "<tr>
                    <td>$no</td>
                    <td>{$row['no_buku']}</td>
                    <td>{$row['nama_lengkap']}</td>
                    <td>{$row['judul']}</td>
                    <td>{$row['nama_kategori']}</td>
                    <td>{$row['tanggal_peminjaman']}</td>
                    <td>{$row['tanggal_pengembalian']}</td>
                    <td>{$row['status_peminjaman']}</td>
                  </tr>";
        $no++;
    }
    $html .= "</table><br>";
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("laporan_peminjaman.pdf");
}

generateHTMLReport($_POST['bulan'], $_POST['status']);
?>
