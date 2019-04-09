<?php
error_reporting(0);
include '../includes/sidebar.php';

$id = $_GET['id'];
$ambilsay = "SELECT daftar_buku.kode_buku, daftar_buku.judul_buku, 
                daftar_buku.pengarang, daftar_buku.kategori, 
                stock_buku.nomor_rak, stock_buku.jumlah_buku 
                FROM daftar_buku 
                INNER JOIN stock_buku 
                ON daftar_buku.kode_buku = stock_buku.kode_buku 
                WHERE daftar_buku.kode_buku = '$id'";
$vira = mysqli_query($koneksi, $ambilsay);
$siti = mysqli_fetch_array($vira);

if(isset($_POST['simpan'])){
    $ids = $_POST['kode_buku'];

    $perubahan_1 = "UPDATE daftar_buku SET 
    judul_buku = '".$_POST['judul_buku']."',
    pengarang = '".$_POST['pengarang']."',
    kategori='".$_POST['kategori']."'
     WHERE kode_buku = '".$ids."'";
    
    $perubahan_2 = "UPDATE stock_buku SET 
    nomor_rak='".$_POST['nomor_rak']."',
    jumlah_buku='".$_POST['jumlah_buku']."' 
    WHERE kode_buku = '".$ids."'";

    $el = mysqli_query($koneksi, $perubahan_1);
    $har = mysqli_query($koneksi, $perubahan_2);

    if($el && $har){
        echo ' <script> alert("Data berhasil diubah!"); 
        location.href="?hal=admin/daftar_buku/list"
        </script> ';
    }


}
?>

<div class="container">
    <div class="form">
        <div class="note">
            <h2  class="p-l-20 p-r-20 p-b-20 p-t-20">
                Edit buku
            </h2>
        </div>
    </div>
</div>

<div class="col-md-12">
<br>
    <form action="" method="post" role="form">
        <!-- <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Kode Buku</label>
                    <input type="text" class="form-control" placeholder="Kode Buku" name="kode_buku">
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Judul Buku</label>
                    <input type="hidden" class="form-control" placeholder="Kode Buku" name="kode_buku" value="<?= $siti['kode_buku'] ?>">
                    <input type="text" class="form-control" placeholder="Judul Buku" name="judul_buku" value="<?= $siti['judul_buku'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Pengarang</label>
                    <input type="text" class="form-control" placeholder="Pengarang" name="pengarang" value="<?= $siti['pengarang'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Kategori</label>
                    <input type="text" class="form-control" placeholder="Kategori" name="kategori" value="<?= $siti['kategori'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Nomor Rak </label>
                    <input type="text" class="form-control" placeholder="Nomor Rak" name="nomor_rak" value="<?= $siti['nomor_rak'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Jumlah Buku</label>
                    <input type="text" class="form-control" placeholder="Jumlah" name="jumlah_buku" value="<?= $siti['jumlah_buku'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <input type="submit" class="btn btn-success" placeholder="Jumlah" name="simpan" value="Simpan">
                </div>
            </div>
        </div>

    </form>
</div>