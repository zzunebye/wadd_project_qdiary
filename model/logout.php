<?php
    session_start();
    unset($_SESSION["useremail"]);
    unset($_SESSION["firstname"]);
    unset($_SESSION['uid']);
    unset($_SESSION['current_q']);
    $_SESSION["isLogin"] = 0;
    header("Location:../signup/loginpage.php");
?>