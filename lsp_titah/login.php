<?php 
include 'includes/head.php';
include 'db/koneksi.php';

?>
<div class="container">
        <div class="row justify-content-md-center p-t-50">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Silahkan Login</h3>
                        <h3 class="panel-title"></h3>

                    </div>
                    <div class="panel-body">
						<form method = "post" action="">
						<fieldset>			
						<br>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="username" name="username" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                        </div>	
                        <div class="form-group">
							<select class="form-control" name="status">
                                <option value="1">Administrator</option>
                                <option value="2">User</option>
                            </select>
						</div>	
						<div class="form-group">
							<input type="submit" class="btn btn-md btn-primary btn-block" name="login" value="login">
						</div>
						<!-- <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<span class="psw">belum punya akun <a href="register.php">daftar disini?</a></span>
							</div>
						</div> -->
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
     </div>
     <?php
     if(isset($_POST['login'])){
					require_once('db/koneksi.php');
					// session_start();
					// session_destroy();
					$username	= $_POST['username'];
                    $password	= $_POST['password'];
                    $status = $_POST['status'];

                    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'
					");
					

					if(mysqli_num_rows($query) == 0){
						echo '<br>';
						echo '<div align="center" class="container">';
						echo '<div class="alert alert-danger">Maaf Login Gagal!</div>';
						echo '</div>';
					}else{
                        $row = mysqli_fetch_assoc($query);
                        session_start();
						if($row['status'] == 'administrator' && $status == 1){
                                $_SESSION['username']=$username;
								$_SESSION['status'] = 'administrator';
								// $_SESSION['nama'] = $ambil['nama'];
								// $_SESSION['alamat'] = $ambil['alamat'];
                                echo '<script language="javascript">alert("Anda berhasil Login sebagai super admin!");
                                document.location="index.php?hal=admin/daftar_buku/list";</script>';
                        }else if($row['status'] == 'user' && $status == 2){
                                $_SESSION['username']=$username;
								$_SESSION['status']="user";
								// $_SESSION['nama'] = $ambil['nama'];
								// $_SESSION['alamat'] = $ambil['alamat'];
                                echo '<script language="javascript">alert("Anda berhasil Login sebagai user!");
                                        document.location="index.php?hal=pinjaman";</script>';
						}else{
							echo '<br>';
                            echo '<div align="center" class="container">';
                            echo '<div class="alert alert-danger">Maaf Login Gagal!</div>';
                            echo '</div>';
						}
                    }
                }
?>
<?php
include 'includes/footer.php';
?>