<?php
error_reporting(0);
include '../includes/sidebar.php';

if(isset($_POST['submit_admin'])){
  //manangkap data yang dikirim
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];

  $cek_dulu = mysqli_query($koneksi, "SELECT * FROM user WHERE username LIKE '$username'");
  $cek = mysqli_num_rows($cek_dulu);
  if($cek==1){
      echo '<script language="javascript">alert("Username telah terpakai!");
      document.location="../master/daftar_user.php";
      </script>';
  }
  else{
      // menginput data ke database
    $data = "INSERT INTO `user` (`id`, `nama`, `username`, `password`, `alamat`, `status`) 
    VALUES (NULL, '$nama', '$username', '$password', '$alamat', '$status')";
    $simpans = mysqli_query($koneksi, $data);
      if($simpans){
      // mengalihkan halaman ke daftar user
      echo '<script language="javascript">alert("Data berhasil ditambahkan!");
      document.location="?hal=admin/daftar_user/list";
      </script>';
    }else{
      echo '<script language="javascript">alert("Gagal Menyimpan!");
      document.location="?hal=admin/daftar_user/list";
      </script>';
  }
  }
}else if(isset($_GET['hapus'])){
  $hapus_user = "DELETE FROM `user` WHERE `user`.`id` = '".$_GET['hapus']."' ";

  $ton = mysqli_query($koneksi, $hapus_user);

  if($ton){
      echo '<script> alert("Hapus Berhasil!");
      location.href="?hal=admin/daftar_user/list";</script> ';
      exit;
  }else {
      echo '<script> alert("Gagal Menghapus !");
      </script> ';
  }
}
?>
<div class="container">
    <div class="form"></div>
        <div class="note">
            <h2  class="p-l-20 p-r-20 p-b-20 p-t-20">
                Daftar User
            </h2>
        </div>
    </div>

        <!-- Button trigger modal -->
        <div class="row">
        <div class="col-md-4 p-l-10 p-t-10 p-b-10 p-r-10 ">
        <button type="button" class="btn btn-primary show-modal" data-toggle="modal">
        <i class="fas fa-plus-square"></i><br>
        Tambah
        </button>
        </div>
        </div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
      <form method="post" action="">
      <div class="form">
                    <div class="form-group row">
                       <label for="inputEmail3" class="col-md-2 col-form-label">Nama</label>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Nama" name="nama" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                       <label for="inputEmail3" class="col-md-2 col-form-label">Username</label>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username"  value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                       <label for="inputEmail3" class="col-md-2 col-form-label">Password</label>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="password" class="form-control pw" placeholder="Password" name="password"  value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                       <label for="inputEmail3" class="col-md-2 col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat"  value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                       <label for="inputEmail3" class="col-md-2 col-form-label">Hak Akses</label>
                        <div class="col-md-8">
                            <div class="form-group">
                                <select class="form-control" name="status">
                                    <option>Pilih</option>
                                    <option value="administrator">Administrator</option>
                                    <option value="user">User</option>
                                </select>    
                            </div>
                        </div>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="submit_admin" value="Simpan" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-12">
    <table class="table table-hover">
  <thead>
  <tr>
      <th scope="row">No</th>
      <td><strong>ID</strong></td>
      <td><strong>Nama</strong></td>
      <td><strong>Username</strong></td>
      <td><strong>Alamat</strong></td>
      <td><strong>Status</strong></td>
      <td><strong>Action</strong></td>
    </tr>
  </thead>
    <tbody>

    <?php 
    $data = mysqli_query($koneksi, "SELECT * FROM user");
    $no = 1;
    while($d = mysqli_fetch_array($data)){

    ?>
    <tr>
      <th scope="row"><?php echo $no; ?></th>
      <td><?php echo $d['id']; ?></td>
      <td><?php echo $d['nama']; ?></td>
      <td><?php echo $d['username']; ?></td>
      <td><?php echo $d['alamat']; ?></td>
      <td><?php echo $d['status']; ?></td>
      <td>
      <a href="?hal=admin/daftar_user/edit&id=<?php echo $d['id'];  ?>" >
      <button class="btn btn-warning">
      Edit
      </button>
      </a>
          <a href="?hal=admin/daftar_user/list&hapus=<?php echo $d['id'];  ?>">
          <button class="btn btn-danger" type="submit" name="hapus">
          Hapus 
          </button>
          </a>
      </td>
    </tr>
<?php
$no++;
}
?>
  </tbody>
</table>
</div></div>


</div>
</div>
</div>
    </div>


    <script type="text/javascript">
$(document).ready(function(){
    $(".show-modal").click(function(){
        $("#myModal").modal({
            backdrop: 'static',
            keyboard: false
        });
    });
});
</script>
    <?php 
include 'includes/footer.php';
?>