<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" href="registerStyle.css" />
  <title>Login</title>
</head>

<body>
<?php
    function alert($msg) {
      echo "<script type='text/javascript'>alert('$msg');</script>";
   }
    require_once('../model/dbconn.php');
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
        $firstname= $_POST['firstname']; 
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user where email = '$email'";
        $rs=mysqli_query($conn,$sql)
		    	or die(mysqli_error($conn));
        if(mysqli_num_rows($rs) == 1){
            alert("Your email is already taken");
            // header("Location:../signup/registerpage.php"); 
        }else{
            $query = "INSERT INTO user (first_name, last_name, email, user_password) VALUES ('$firstname','$lastname','$email','$password')";
            $rs = mysqli_query($conn, $query)
                or die(mysqli_error($conn));
            session_start();
            $_SESSION["useremail"] = $email;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["isLogin"] = 1;
            $_SESSION['current_q'] = 0;
            header("location: ../index.php");
        }
    }
?>
  <div class="container">
    
    <form id="form" class="form" method="post" action="">
      <h2>Register With Us</h2>
      <div class="form-control">
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" placeholder="Enter username" value="" required />
        <small>Please input your first name</small>
      </div>
      <div class="form-control">
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" placeholder="Enter username" value="" required />
        <small>Please input your last name</small>
      </div>
      <div class="form-control">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Enter email" value="" required />
        <small>Your email is not valid!</small>
      </div>
      <div class="form-control">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter password" value="" required />
        <small>Your passwords should be more than 6 digits</small>
      </div>
      <div class="form-control">
        <label for="password2">Confirm Password</label>
        <input type="password" id="confirm" placeholder="Enter password again" />
        <small>Your password does not match!</small>
      </div>
      <button type="submit" id="submit" class="unable">Submit</button>
    </form>
    <div class="toLogin">
      <ul class="navigation">
        <li class="navi">You already have account? <a href="./loginPage.php">Log In</a></li>
      </ul>
    </div>
  </div>

  <script src="registerjs.js"></script>
</body>

</html>