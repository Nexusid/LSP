<?php
error_reporting(0);
include '../includes/sidebar_member.php';
$sessi = "SELECT * FROM user WHERE username = '".$_SESSION['username']."'";
$datass = mysqli_query($koneksi, $sessi);
$ds = mysqli_fetch_array($datass);
$namas = $ds['nama'];
$alamats = $ds['alamat'];
$users = $ds['username'];

?>
<div class="container">
    <div class="form">
        <div class="note">
            <h2  class="p-l-20 p-r-20 p-b-20 p-t-20">
                Report
            </h2>
        </div>
    </div>
</div>
<div class="col-md-12 main-content">
  <br>
  <div class="row justify-content-md-center">
    <div class="col-md-12">
    <table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">ID Peminjam</th>
      <th scope="col">Nama Peminjam</th>
      <th scope="col">Tanggal Peminjam</th>  
      <th scope="col">Tanggal Kembali</th>  
      <th scope="col">Denda</th>  
      <th scope="col">Status</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $queryTransaksi = mysqli_query($koneksi, "SELECT * FROM 
                                peminjaman
                                    WHERE username = '$users' ");
    while($rows = mysqli_fetch_array($queryTransaksi)){
    ?>
    <tr>
      <th scope="row"><?= $no++; ?></th>

      <td><?= $rows['id_peminjam'] ?></td>
      <td><?= $rows['nama_peminjam'] ?></td>
      <td><?= $rows['tanggal_peminjam'] ?></td>
      <td><?= $rows['tanggal_kembali'] ?></td>
      <td><?= $rows['denda'] ?></td>
      <td>
      <b>
            <?php if($rows['status_peminjam'] == 'DIPINJAM'){ ?>
                <p class="bg-warning text-dark p-2 mb-1">
            <?php echo $rows['status_peminjam']; 
            }else{ ?>
            <p class="bg-success text-white p-2 mb-1">
            <?= $rows['status_peminjam']; } ?>

        </p>
            </b>
                            
      </td>
      <td>
        <a href="?hal=member/report/detail&id=<?= $rows['id_peminjam'] ?>" >
          <button class='btn btn-secondary' name="">Detail</button>
        </a>
      </td>
    </tr>
      <?php
    }
      ?>
    </tbody>
    </table>
    </div>
  </div>

</div>
