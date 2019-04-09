<?php 
include 'includes/head.php';

error_reporting(0);
$id = $_GET['id'];
$queryRowOrder = mysqli_query($koneksi, "SELECT * FROM daftar_buku 
                    INNER JOIN peminjaman_detail
                        ON daftar_buku.kode_buku = peminjaman_detail.kode_buku
                    INNER JOIN peminjaman
                        ON peminjaman.id_peminjam = peminjaman_detail.id_peminjam
                    WHERE peminjaman.id_peminjam = '".$id."'");


?>

<div class="col-md-12 col-sm-8 main-content">
    <br>
    <div class="container">
        <div class="form">
            <div class="note">
                <h2 class="p-l-20 p-r-20 p-b-20 p-t-20">Transaksi Detail</h2>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row justify-content-md-center">
    
        <div class="col-md-12">
            
            <table id="cssTable">
                <?php 
                    $qOrder = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjam ='".$id."' ");
                    $dataOrder = mysqli_fetch_array($qOrder);
                ?>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td align="left"> <strong> <?php echo $dataOrder['nama_peminjam'] ?></strong></td>
                </tr>
                <tr>
                    <td align="left">Alamat Peminjam</td>
                    <td>:</td>
                    <td><strong><?php echo $dataOrder['alamat_peminjam'] ?></strong></td>
                </tr>
            </table>
        </div>
    </div>
<style>
#cssTable td{
    text-align: left;
    vertical-align: middle;
}
</style>
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <table class="table table-hover table-bordered" id="cssTable">
                <thead>
                    <tr>
                        <td><strong> No</strong></td>
                        <td><strong> Nama Buku</strong></td>
                        <td><strong> Pengarang</strong></td>
                        <td><strong> Kategori</strong></td>
                        <td><strong> Jumlah</strong></td>
                        <td><strong> Tanggal Peminjam</strong></td>
                        <td><strong> Tanggal Kembali</strong></td>
                        <td><strong> Denda</strong></td>
                        <td><strong> Status</strong></td>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        $total = 0;

                        while($data = mysqli_fetch_array($queryRowOrder)) {
                            // $sub_total = +$data['product_price'] * $data['jumlah'];
                            // $total += $sub_total;
                    ?>
                    <tr>
                        <td><?php echo $no++;  ?></td>
                        <td><?php echo $data['judul_buku'] ?></td>
                        <td><?php echo $data['pengarang'] ?></td>
                        <td><?php echo $data['kategori'] ?></td>
                        <td><?php echo $data['jumlah']  ?></td>
                        <td><?php echo $data['tanggal_peminjam'] ?></td>
                        <td><?php echo $data['tanggal_kembali'] ?></td>
                        <td><?php echo $data['denda'] ?></td>
                        <td>
                            <b>
                                <?php if($data['status_peminjam'] == 'DIPINJAM'){ ?>
                                    <p class="bg-warning text-dark p-3 mb-2">
                                <?php echo $data['status_peminjam']; 
                                }else{ ?>
                                <p class="bg-success text-white p-3 mb-2">
                                <?= $data['status_peminjam']; } ?>

                        </p>
                            </b>
                        </td>
                    </tr>
                        <?php } ?>   
                </tbody>
            </table>
        </div>
        <div class="col-md-10" align="left">
            <div class="row">
                <div class="col-md-2">
                    <a href="?hal=member/report/list" class="btn btn-primary btn-block">Back</a>
                </div>
            </div>
        </div>
    </div>
    

</div>