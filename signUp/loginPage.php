<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="loginStyle.css" />
  <title>Login</title>
</head>

<body>
<?php
    require_once('../model/dbconn.php');
    session_start();
    $_SESSION['isLogin'] = 0;
    if (isset($_SESSION['useremail'])) {
      // echo $_SESSION['isLogin'];
    }
    ?>
  <div class="container">
    
    <div class="title">
      <h1>Q - Journal</h1>
    </div>
    <div class="coverPicture">
    </div>
    <form id="form" class="form" action="../model/login.php" method="POST">
      <h2>LogIn With Us</h2>
      <div class="form-control">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter email" />
        <small>Error message</small>
      </div>
      <div class="form-control">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password" />
        <small>Error message</small>
      </div>
      <button name="submit" type="submit" value="Login">Submit</button>

      <div class="toRegister">
        <ul class="navigation">
          <li class="navi">You do not have account? <a href="./registerPage.php">Register</a></li>
        </ul>
      </div>
    </form>

  </div>
  <script src="./loginjs.js"></script>
</body>

</html>