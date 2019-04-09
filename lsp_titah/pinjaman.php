<?php
error_reporting(0);
// include 'includes/sidebar_member.php';
date_default_timezone_set('Asia/Jakarta');

$id_session = session_id();

?>
<div class="container">
    <div class="form">
        <div class="note">
            <h2  class="p-l-20 p-r-20 p-b-20 p-t-20">
                Pinjam Buku
            </h2>
        </div>
    </div>
</div>
<div class="col-md-12 main-content">
    <br>
<div class="row">
  <div class="col-md-8">
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
              <a href="proses_pinjam.php?mod=basket&act=add&id=<?= $d['kode_buku'] ?>" class="btn btn-danger">
              
              Tambah
              
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
  <div class="col-md-4">
  <table class="table table-hover table-bordered">
  <thead style="text-align:center; vertical-align:middle;">
    <tr>
      <td></td>
      <td align="center" scope="col"><strong>Judul Buku</strong></td>
      <td align="center" scope="col"><strong>Pengarang</strong></td>
      <td align="center" scope="col"><strong>Jumlah Buku</strong></td>
    </tr>
  </thead>
  <tbody>
        <?php
          $query = "SELECT * FROM daftar_buku
          INNER JOIN peminjaman_temp
              ON daftar_buku.kode_buku = peminjaman_temp.kode_buku 
              WHERE peminjaman_temp.id_session = '".$id_session."'";
      $result = mysqli_query($koneksi, $query);
      $no = 1;
      $total = 0;

      while($data = mysqli_fetch_array($result)){
          // $sub_total = +$data['product_price'] * $data['jumlah'];
          // $total += $sub_total;
        ?>
    <tr>
      <th scope="row">
      <a href="proses_pinjam.php?mod=basket&act=del&id=<?php echo $data['id_peminjam_temp'];  ?>">
      &times;
      </a>
      </th>
      <td><?= $data['judul_buku'] ?></td>
      <td><?= $data['pengarang'] ?></td>
      <td><?= $data['jumlah'] ?></td>
    </tr>
        <?php
      }
        ?>
  </tbody>
</table>
<form action="?hal=cetak" method="post">
      <div class="row">
        <div class="col-md-2">
          <button class="btn btn-danger" type="submit">OK</button>
        </div>
      </div>
</form>
  </div>
</div>

</div>
