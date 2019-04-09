<?php 
include 'head.php';

?>
<div class="container-fluid">
<div class="row">
<div class="col-md-2 col-sm-4 sidebar1">
                <div class="respon1">
                <h2><strong>MEMBER</strong></h2>
                <hr>
                </div>
                <div class="left-navigation">
                    <ul class="list">
                    <li><a href="?hal=pinjaman"  class="warna">Pinjam Buku</a></li>
                        <li><a href="?hal=member/report/list" class="warna">Report</a></li>
                        <!-- <li><a href="?hal=admin/report/list"  class="warna">Daftar Peminjam</a></li> -->
                        <li><a href="logout.php"  class="warna">Logout</a></li>
                    </ul>
                </div>
            </div>

<?php 
include 'footer.php';
?>