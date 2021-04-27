<?php
    session_start();
    unset($_SESSION["useremail"]);
    unset($_SESSION["firstname"]);
    $_SESSION["isLogin"] = 0;
    header("Location:../signup/loginpage.php");
?>