<?php
session_start();
// error_reporting(0);
require_once('db/koneksi.php');
include 'tanggal.php';
$mod = $_GET['mod'];
$act = $_GET['act'];

if ($mod == 'basket' AND $act == 'add') {
    $sid = session_id();
    $sql = mysqli_query($koneksi, "SELECT jumlah_buku FROM stock_buku WHERE kode_buku='$_GET[id]'");
    $s = mysqli_fetch_array($sql);
    $stok = $s['jumlah_buku'];

    if($stok == 0) {
        echo "<script>alert('Stock habis'); location.href='index.php?hal=pinjaman' </script>";
        exit();
    }else {

        $sql_temp = mysqli_query($koneksi, "SELECT * FROM peminjaman_temp
            WHERE kode_buku ='$_GET[id]' AND id_session='$sid' ");
        $data_tmp = mysqli_fetch_array($sql_temp);
        $ketemu = mysqli_num_rows($sql_temp);
        if(!empty($data_tmp['stok_temp'])) {
            if($data_tmp['jumlah'] >= $stok) {
                echo "<script> alert('Jumlah yang dibeli sedang kosong'); location.href='index.php?hal=pinjaman'  </script>";
                exit();
            }
        }

        if($ketemu == 0) {
            // masuk produk ke product di table cart

            mysqli_query($koneksi, "INSERT INTO peminjaman_temp 
            (id_peminjam_temp, kode_buku, jumlah, id_session, tanggal_peminjam_temp, tanggal_kembali_temp, stok_temp)
            VALUES (NULL, '$_GET[id]', 1, '$sid', '$tgl_sekarang', '$tgl_tambah', '$stok') ");
        }else {
            // update qty product qty di cart table

            mysqli_query($koneksi, "UPDATE peminjaman_temp 
                SET jumlah = jumlah + 1
                WHERE id_session = '$sid' AND kode_buku='$_GET[id]' ");
        }
        deleteAbandonedCart();
        echo '<script>  alert("Product berhasil dibeli"); location.href="index.php?hal=pinjaman" </script>';
        exit;
    }
} else if($mod == 'basket' AND $act == 'del') {
    mysqli_query($koneksi, "DELETE FROM peminjaman_temp WHERE id_peminjam_temp = '$_GET[id]' ");
    echo "<script> alert('Daftar Buku berhasil dihapus!'); location.href='index.php?hal=pinjaman' </script>";
    exit;
}

//MENGHAPUS KERANJANG YANG SUDAH USANG
function deleteAbandonedCart() {
    include 'db/koneksi.php';
    $kemarin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
    mysqli_query($koneksi, "DELETE FROM peminjaman_temp
        WHERE tgl_peminjaman_temp < '$kemarin'");
}

?>