<?php
session_start();
unset($_SESSION['username']);
session_destroy();
echo '<script language="javascript">alert("Berhasil keluar!");
location.href="index.php";
</script>';
?>