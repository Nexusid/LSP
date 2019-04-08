<html>
<head>
	<title>Halaman admin</title>
</head>
<body>
	<?php 
	session_start();
 
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['status']==""){
		header("location:index.php?pesan=gagal");
	}
 
	?>
	<h1>Halaman Admin</h1>
 
	<p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['status']; ?></b>.</p>
	<a href="databases/logout.php">LOGOUT</a>
 
	<br/>
	<br/>

</body>
</html>