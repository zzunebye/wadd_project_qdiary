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
      <form id="form" class="form">
        <h2>Register With Us</h2>
        <div class="form-control">
          <label for="username">Username</label>
          <input type="text" id="username" placeholder="Enter username" />
          <small>Error message</small>
        </div>
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
        <div class="form-control">
          <label for="password2">Confirm Password</label>
          <input
            type="password"
            id="confirm"
            placeholder="Enter password again"
          />
          <small>Error message</small>
        </div>
        <button type="submit">Submit</button>
      </form>
      <div class="toLogin">
          <ul class="navigation">
            <li class="navi">You already have account?  <a href="./login.php">Log In</a></li>        
          </ul>
        </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
