<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.css.map">
    <style>
    </style>
</head>
<body>
<div class="wrapper">
    <form class="form-signin">       
      <h2 class="form-signin-heading">Tambah User</h2>
      <input type="text" class="form-control" name="username" placeholder="username" required="" autofocus="" />
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
      <select class="form-control">
        <option value="admin">Administrator</option>
        <option value="user">User</option>
      </select>
      <button class="btn btn-lg btn-primary btn-block" type="submit_login">Login</button>   
    </form>
  </div>
</body>
</html>