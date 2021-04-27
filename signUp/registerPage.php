<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="registerStyle.css" />
  <title>Login</title>
</head>

<body>
  <div class="container">
    <?php
    require_once('../model/dbconn.php')
    ?>
    <form id="form" class="form" method="post" action="../model/register.php">
      <h2>Register With Us</h2>
      <div class="form-control">
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" placeholder="Enter username" value="" required />
        <small>Error message</small>
      </div>
      <div class="form-control">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" placeholder="Enter username" value="" required />
        <small>Error message</small>
      </div>
      <div class="form-control">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter email" value="" required />
        <small>Error message</small>
      </div>
      <div class="form-control">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" value="" required />
        <small>Error message</small>
      </div>
      <div class="form-control">
        <label for="password2">Confirm Password</label>
        <input type="password" id="confirm" placeholder="Enter password again" />
        <small>Error message</small>
      </div>
      <button type="submit">Submit</button>
    </form>
    <div class="toLogin">
      <ul class="navigation">
        <li class="navi">You already have account? <a href="./loginPage.php">Log In</a></li>
      </ul>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>