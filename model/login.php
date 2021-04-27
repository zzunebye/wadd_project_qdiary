<script>
    console.log("LOGIN PAGE")
</script>
<?php


// var_dump($_POST, "\n\n");
echo nl2br("\n\n");
function Login()
{
    require_once('./dbconn.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE email = '$email' AND user_password = '$password'";
    // $rs = mysqli_query($conn, $query)
    //     or die(mysqli_error($conn));
    
    echo ($query);
    echo nl2br("\n\n");

    // echo "1";
    $result = $conn->query($query);
    print_r($result);
    echo nl2br("\n\n");
    // echo($rs);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    
    if($count == 1) {
        // echo nl2br("This is registered user\n\n");
        
        session_start();
        $_SESSION['useremail'] = $row['email'];
        $_SESSION['isLogin'] = 1;
        $_SESSION['firstname'] = $row['first_name'];
        // print_r($_SESSION['useremail']);
        // echo nl2br("\n\n");

        header("location: ../home.php");
    } else {
        $error = "Your Login Name or Password is invalid";
        echo nl2br("Your Login Name or Password is invalid\n\n");
        header("location: ../signUp/loginPage.php");
    }
}


if (isset($_POST['submit'])) {
    Login();
}

?>
<script>
    
</script>