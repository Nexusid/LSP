<!DOCTYPE html>
<?php
if(isset($_GET['pesan'])){
  if($_GET['pesan']=="gagal"){
    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
  }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="wrapper">
    <form action="cek_login.php" method="post" class="form-signin">       
      <h2 class="form-signin-heading">Selamat Datang!</h2>
      <input type="text" class="form-control" name="username" placeholder="username" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      <label class="checkbox">
        <input type="checkbox" value="remember-me" id="rememberme" name="remember-me"> Remember me
      </label>
      <button class="btn btn-lg btn-primary btn-block" type="submit_login">Login</button>   
    </form>
  </div>
</body>
</html>