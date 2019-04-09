<?php
error_reporting(0);
include '../includes/sidebar.php';

$id = $_GET['id'];
$ambilsay = "SELECT * FROM user WHERE id = '$id'";
$vira = mysqli_query($koneksi, $ambilsay);
$siti = mysqli_fetch_array($vira);

if(isset($_POST['simpan'])){
    $ids = $_POST['id'];

    $perubahan_1 = "UPDATE `user` SET 
    `nama`='".$_POST['nama']."',
    `username`='".$_POST['username']."',
    `password`='".$_POST['password']."',
    `alamat`='".$_POST['alamat']."',
    `status`='".$_POST['status']."'
    WHERE id = '".$ids."' ";

    $el = mysqli_query($koneksi, $perubahan_1);

    if($el){
        echo ' <script> alert("Data berhasil diubah!"); 
        location.href="?hal=admin/daftar_user/list"
        </script> ';
    }


}
?>

<div class="container">
    <div class="form">
        <div class="note">
            <h2  class="p-l-20 p-r-20 p-b-20 p-t-20">
                Edit User
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
                    <label align="left">Nama</label>
                    <input type="hidden" class="form-control" placeholder=" " name="id" value="<?= $siti['id'] ?>">
                    <input type="text" class="form-control" placeholder=" " name="nama" value="<?= $siti['nama'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Username</label>
                    <input type="text" class="form-control" placeholder="" name="username" value="<?= $siti['username'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Password</label>
                    <input type="password" class="form-control" placeholder="" name="password" value="<?= $siti['password'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">alamat </label>
                    <input type="text" class="form-control" placeholder=" " name="alamat" value="<?= $siti['alamat'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <label align="left">Status</label>
                    <select class="form-control" name="status">
                        <option value="administrator">Administrator</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8" align="left">
                <div class="form-group">
                    <input type="submit" class="btn btn-success" placeholder="" name="simpan" value="Simpan">
                </div>
            </div>
        </div>

    </form>
</div>