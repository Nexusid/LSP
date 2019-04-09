<?php
error_reporting(0);
include '../includes/sidebar.php';

if(isset($_POST['tambah_buku'])){
    $tambah_buku ="INSERT INTO `daftar_buku` (`kode_buku`, `judul_buku`, `pengarang`, `kategori`) 
    VALUES ('".$_POST['kode_buku']."', '".$_POST['judul_buku']."', '".$_POST['pengarang']."', '".$_POST['kategori']."')";

    $tambah_stock = "INSERT INTO `stock_buku` (`nomor_rak`, `jumlah_buku`, `kode_buku`) 
    VALUES ('".$_POST['nomor_rak']."', '".$_POST['jumlah_buku']."', '".$_POST['kode_buku']."')";

    $khalid = mysqli_query($koneksi, $tambah_buku);
    $basalamah = mysqli_query($koneksi, $tambah_stock);

    if($khalid && $basalamah){
        echo '<script> alert("Tambah Berhasil");
        location.href="?hal=admin/daftar_buku/list";</script> ';
    }else if(!$khalid && !$basalamah){
        echo '<script> alert("Gagal Menambahkan !");
        </script> ';
    }
}else if(isset($_GET['hapus'])){
    $id = $_GET['kode_buku'];
    $hapus_buku = "DELETE FROM `daftar_buku` WHERE `daftar_buku`.`kode_buku` = '".$_GET['hapus']."' ";
    $hapus_stock = "DELETE FROM `stock_buku` WHERE `stock_buku`.`kode_buku` = '".$_GET['hapus']."' ";

    $say = mysqli_query($koneksi, $hapus_buku);
    $ton = mysqli_query($koneksi, $hapus_stock);

    if($say && $ton){
        echo '<script> alert("Hapus Berhasil!");
        location.href="?hal=admin/daftar_buku/list";</script> ';
        exit;
    }else {
        echo '<script> alert("Gagal Menghapus !");
        </script> ';
    }
}

?>
<div class="container">
    <div class="form">
        <div class="note">
            <h2  class="p-l-20 p-r-20 p-b-20 p-t-20">
                Daftar Buku
            </h2>
        </div>
    </div>
</div>
<div class="col-md-12 main-content">
    <br>
    <div class="row">
        <div class="col-md-5">
            <button type="button" class="btn btn-primary btn-default" data-toggle="modal" data-target="#modalsatu" >
                Tambah Buku
            </button>

            <!-- start modal -->
            <div class="modal fade " id="modalsatu" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title">Tambah Buku</h5>
                                <button class="close" type="button" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" role="form">

                            <div class="row">
                                <div class="col-md-8" align="left">
                                    <div class="form-group">
                                        <label align="left">Kode Buku</label>
                                        <input type="text" class="form-control" placeholder="Kode Buku" name="kode_buku">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8" align="left">
                                    <div class="form-group">
                                        <label align="left">Judul Buku</label>
                                        <input type="text" class="form-control" placeholder="Judul Buku" name="judul_buku">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8" align="left">
                                    <div class="form-group">
                                        <label align="left">Pengarang</label>
                                        <input type="text" class="form-control" placeholder="Pengarang" name="pengarang">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8" align="left">
                                    <div class="form-group">
                                        <label align="left">Kategori</label>
                                        <input type="text" class="form-control" placeholder="Kategori" name="kategori">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8" align="left">
                                    <div class="form-group">
                                        <label align="left">Nomor Rak </label>
                                        <input type="text" class="form-control" placeholder="Nomor Rak" name="nomor_rak">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8" align="left">
                                    <div class="form-group">
                                        <label align="left">Jumlah Buku</label>
                                        <input type="text" class="form-control" placeholder="Jumlah" name="jumlah_buku">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning" data-dismiss="modal" type="button">Close</button>
                            <input class="btn btn-primary" type="submit" name="tambah_buku" value="Tambah">
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<table class="table table-hover table-bordered">
  <thead style="text-align:center; vertical-align:middle;">
    <tr>
      <td align="center" scope="col"><strong>No</strong></td>
      <td align="center" scope="col"><strong>Kode Buku</strong></td>
      <td align="center" scope="col"><strong>Judul Buku</strong></td>
      <td align="center" scope="col"><strong>Pengarang</strong></td>
      <td align="center" scope="col"><strong>Kategori</strong></td>
      <td align="center" scope="col"><strong>Nomor Rak</strong></td>
      <td align="center" scope="col"><strong>Jumlah Buku</strong></td>
      <td align="center" scope="col"><strong>Action</strong></td>
    </tr>
  </thead>
  <tbody>
      <?php 
        $no = 1;
        $abdul = "SELECT daftar_buku.kode_buku, daftar_buku.judul_buku,
                        daftar_buku.pengarang, daftar_buku.kategori, stock_buku.nomor_rak, 
                        stock_buku.jumlah_buku 
                            FROM daftar_buku 
                                INNER JOIN stock_buku 
                            ON daftar_buku.kode_buku = stock_buku.kode_buku ORDER BY kode_buku ASC";
        $somad = mysqli_query($koneksi, $abdul);
        while($d = mysqli_fetch_array($somad)){
      ?>
    <tr>
      <th scope="row"><?= $no++; ?></th>
      <td><?= $d['kode_buku'] ?></td>
      <td><?= $d['judul_buku'] ?></td>
      <td><?= $d['pengarang'] ?></td>
      <td><?= $d['kategori'] ?></td>
      <td><?= $d['nomor_rak'] ?></td>
      <td><?= $d['jumlah_buku'] ?></td>
      <td>
          <div class="btn-group">
              <a href="?hal=admin/daftar_buku/edit&id=<?= $d['kode_buku'] ?>">
              <button class="btn btn-warning" type="submit">
              Edit
              </button>  
              </a>
              <a href="?hal=admin/daftar_buku/list&hapus=<?= $d['kode_buku'] ?>">
                <button class="btn btn-danger" type="submit" name="hapus">
                    Hapus
                </button>
              </a>
          </div>
      </td>
    </tr>
    <?php 
        }
    ?>
  </tbody>
</table>
</div>
