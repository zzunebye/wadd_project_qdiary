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
    <div class="container">
      <div class="title">
          <h1>Q - Journal</h1>
      </div>
      <div class="coverPicture">
      </div>
      <form id="form" class="form">
          <h2>LogIn With Us</h2>
          <div class="form-control">
            <label for="email">Email</label>
            <input type="text" id="email" placeholder="Enter email" />
            <small>Error message</small>
          </div>
          <div class="form-control">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter password" />
            <small>Error message</small>
          </div>
          <button type="submit">Submit</button>
          <div class="toRegister">
          <ul class="navigation">
            <li class="navi">You do not have account?  <a href="./register.php">Register</a></li>        
          </ul>
        </div>
      </form>

    </div>
    <script src="script.js"></script>
  </body>
</html>
