<?php
					require_once('db/koneksi.php');
					// session_start();
					// session_destroy();
					$username	= $_POST['username'];
                    $password	= $_POST['password'];
                    $status = $_POST['status'];

					$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

					if(mysqli_num_rows($query) == 0){
						echo '<br>';
						echo '<div align="center" class="container">';
						echo '<div class="alert alert-danger">Maaf Login Gagal!</div>';
						echo '</div>';
					}else{
						$row = mysqli_fetch_assoc($query);
						if($row['status'] == 'administrator' ){
							session_start();
							$_SESSION['username']=$username;
							$_SESSION['hak_akses']="administator";
							echo '<script language="javascript">alert("Anda berhasil Login sebagai super admin!")</script>';
							header('Location: index.php?hal=dashboard');
						}else if ($row['status'] == 'user') {
							session_start();
							$_SESSION['username']=$username;
							$_SESSION['statur']="user";
                            echo '<script language="javascript">alert("Anda berhasil Login sebagai user!");
                            document.location="index.php?hal=admin/dashboard";</script>';
						}else{
							echo '<script language="javascript">alert("Maaf Login Gagal!");</script>';
						}
					}
?>