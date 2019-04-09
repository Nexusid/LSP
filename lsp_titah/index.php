<?php
include 'includes/head.php';
include 'function.php';
session_start();
require_once('db/koneksi.php');
if(!empty($_SESSION['username']) && !empty($_SESSION['status'])){
?>
    <section>
        <!-- left side start-->
        <?php 
        if($_SESSION['status'] == 'administrator'){
            include("includes/sidebar.php"); 
        }else{
            include("includes/sidebar_member.php"); 
        }
        ?>
        
        <!-- left side end-->

        <!-- main content start-->
        <div class="col-md-10 main-content">
            <!--body wrapper start-->
            <?php
            // include 'menuatas-member.php';
            if (isset($_GET['hal']) && strlen($_GET['hal']) > 0) {
                $hal = str_replace(".", "/", $_GET['hal']) . ".php";
            }
            else {
                $hal = "dashboard.php";
            }
            if (file_exists($hal)) {
                include($hal);
            } else {
                include("dashboard.php");
            }
            ?>
            <!--body wrapper end-->
            <!--footer section start-->

            <!--footer section end-->
        </div>
        <!-- main content end-->
	</section>
<?php 
}else{
	header("Location: login.php");
}
?>
