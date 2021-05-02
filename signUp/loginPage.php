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
  function alert($msg)
  {
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
  require_once('../model/dbconn.php');
  session_start();
  $_SESSION['isLogin'] = 0;

  if (isset($_POST['email']) == true && isset($_POST['password']) == true) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE email = '$email' AND user_password = '$password'";

    $result = $conn->query($query);

    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($count == 1) {


      $_SESSION['useremail'] = $row['email'];
      $_SESSION['uid'] = $row['user_id'];
      $_SESSION['isLogin'] = 1;
      $_SESSION['firstname'] = $row['first_name'];

      $userid = $_SESSION['uid'];
      $query = "SELECT is_done FROM quarantine WHERE user_id = '$userid' AND is_done=0";
      $result = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
      $row = mysqli_fetch_array($result);
      $quarantine_on = $row['is_done'];
      

      if ($quarantine_on != 1 && $quarantine_on != NULL) {
        $query = "SELECT * FROM quarantine WHERE user_id = '$userid' AND is_done = 0";
        $result = mysqli_query($conn, $query)
          or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        $start = $row['start_date'];
        $duration = $row['duration'];
        $qid = $row['quarantine_id'];
        $_SESSION['current_q'] = $row['quarantine_id'];
      } else {
        $_SESSION['current_q'] = 0;
      }


      header("location: ../index.php");
    } else {
      $error = "Your email or Password is invalid";
      alert($error);
      // header("location: loginPage.php");
    }
  }
  // email validation



  ?>
  <div class="container">

    <div class="title">
      <h1>Q - Journal</h1>
    </div>
    <div class="coverPicture">
    </div>
    <form id="form" class="form" action="" method="POST">
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