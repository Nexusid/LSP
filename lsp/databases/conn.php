<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "perpus_mahasiswa";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_error()){
	echo "Gagal dalam melakukan koneksi database: ".mysqli_connect_error();
}
else{
}
?>
