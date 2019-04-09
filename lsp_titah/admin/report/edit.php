<?php
$id = $_GET['id'];
$ambilsay = "SELECT * FROM peminjaman WHERE id_peminjam = '$id'";

$vira = mysqli_query($koneksi, $ambilsay);

$siti = mysqli_fetch_array($vira);


    // $ids = $_POST['id_peminjam'];

    $perubahan_1 = "UPDATE `peminjaman` SET 
    `status_peminjam`='DIKEMBALIKAN'
    WHERE id_peminjam = '$siti[id_peminjam]' ";

    $el = mysqli_query($koneksi, $perubahan_1);

    if($el){
        echo ' <script> alert("Data berhasil diubah!"); 
        location.href="?hal=admin/report/list"
        </script> ';
    }else{
        echo ' <script> alert("Data Gagal Dirubah !"); 
        location.href="?hal=admin/report/list"
        </script> ';
    }
?>
<form method = "post" action="" >
<input type="text" value="<?= $siti['id_peminjam']; ?>" name="id_peminjam">
</form>