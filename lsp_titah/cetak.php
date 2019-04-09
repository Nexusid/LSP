<?php 
include 'includes/head.php';
include 'tanggal.php';
date_default_timezone_set('Asia/Jakarta');
require_once('db/koneksi.php');
// session_start();
$sessi = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
$datass = mysqli_query($koneksi, $sessi);
$ds = mysqli_fetch_array($datass);
$namas = $ds['nama'];
$alamats = $ds['alamat'];
$users = $ds['username'];
// $namas = $ds['nama'];
// $ss1= mysqli_fetch_array($sessi);   
// $ssid = session_id();

function isi_keranjang($koneksi) {
    // require_once('../../db/koneksi.php');
    
    $isikeranjang = array();
    $sid = session_id();
    $sql2 = "SELECT * FROM peminjaman_temp WHERE id_session = '$sid'";
    $sql = mysqli_query($koneksi, $sql2);

    while ($r = mysqli_fetch_assoc($sql)){
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}

$isikeranjang = isi_keranjang($koneksi);
$jml = count($isikeranjang);

if($jml == 0){
    echo '<script> alert("Produk masih kosong!"); location.href="index.php?hal=peminjam" </script>';
    exit();
}

$jam_skrg = date('H:i:s');

// simpan data pemesanan
mysqli_query($koneksi, "INSERT INTO peminjaman (id_peminjam, nama_peminjam, alamat_peminjam, tanggal_peminjam, tanggal_kembali ,denda, status_peminjam, username) 
                    VALUES (NULL, '".$namas."', '".$alamats."', '$tgl_sekarang', '$tgl_tambah', NULL,'DIPINJAM', '$users') ");

// mendapat nomor order
$id_peminjam = mysqli_insert_id($koneksi);
//panggil fungsi isi keranjang dan hitung produk yang dipesan

//simpan data detail pemesanan
for($i = 0; $i < $jml; $i++){
    mysqli_query($koneksi, "INSERT INTO peminjaman_detail(id_peminjam, kode_buku, jumlah)
                    VALUES('$id_peminjam', {$isikeranjang[$i]['kode_buku']}, {$isikeranjang[$i]['jumlah']})");
    
mysqli_query($koneksi, "UPDATE stock_buku SET jumlah_buku = jumlah_buku - {$isikeranjang[$i]['jumlah']} WHERE kode_buku={$isikeranjang[$i]['kode_buku']}");
}

for($i=0; $i < $jml; $i++){
    mysqli_query($koneksi, "DELETE FROM peminjaman_temp WHERE id_peminjam_temp = {$isikeranjang[$i]['id_peminjam_temp']}  ");
    
}

$daftarproduk = mysqli_query($koneksi, "SELECT * FROM peminjaman_detail, daftar_buku
                                            WHERE peminjaman_detail.kode_buku = daftar_buku.kode_buku
                                            AND id_peminjam = '$id_peminjam' ");
?>
<style>
td {
    /* font-family: 'Lucida Console', Monaco, monospace, sans-serif; color:black; */
}
.def{
    /* font-family: 'Montserrat', sans-serif; */
    font-family: 'Lucida Console', Monaco, monospace, sans-serif; color:black;
}
</style>
<div class="limiter">
    <div class="container-home100">
        <div class="row">
            <div class="col-md-6" align="left">
            <div class="row">
            <div class="col-sm-1" align="right">
            <!-- <a href="../home.php">
            <i class="fas fa-chevron-left" style="font-size:30px;"></i>
            </a> -->
            </p>
            </div>
            </div>
            </div>
            <div class="col-md-6">
            <!-- COL -->
            </div>
        </div>
    <br><br>
    
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                    <br>
                        <div class="card">
    
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <table class="table table-borderless">
                                        <thead>

                                        </thead>    
                                        <tbody>
                                            <tr>
                                                <td>Nama Peminjam</td>
                                                <td>:</td>
                                                <td><?= $namas ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alamat Peminjam</td>
                                                <td>:</td>
                                                <td><?= $alamats ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td><strong>Kode Buku</strong></td>
                                            <td><strong>Nama Buku</strong></td>
                                            <td><strong>Pengarang</strong></td>
                                            <td><strong>Kategori</strong></td>
                                            <td><strong>Jumlah</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $total = 0;
                                    while($data = mysqli_fetch_array($daftarproduk)){
                                        // $sub_total = +$data['product_price'] * $data['jumlah'];
                                        // $total  += $sub_total;
                                    ?>
                                        <tr>
                                            <td><?php echo $data['kode_buku']; ?></td>
                                            <td><?php echo $data['judul_buku']; ?></td>
                                            <td><?php echo $data['pengarang']; ?></td>
                                            <td><?php echo $data['kategori']; ?></td>
                                            <td><?php echo $data['jumlah']; ?></td>
                                        </tr>
                                    <?php } ?>
                                        <tr>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                        <!-- print new -->
                                                <form method="post" action="struct_print.php" target="_blank">
                                                    <input type="hidden" name="cash" value="<?php echo $_POST['cash']; ?>">

                                                    <input type="hidden" name="id_orders" value="<?php echo $id_orders; ?>">

                                                <!-- <button class="btn btn-primary" type="submit">
                                                        <i class="fa fa-print"></i> print
                                                    </button> -->
                                                    <a href="index.php?hal=pinjaman" class="btn btn-success btn-block">Selesai</a>
                                            <!-- <a class="btn btn-primary btn-lg" target="_blank" href="struct_print.php"><i class="fa fa-print"></i> Print </a> -->
                                        </form>
                                                        <!-- print end -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    

</div>






<?php 
include 'includes/footer.php';
?>