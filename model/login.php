<script>
    console.log("LOGIN PAGE")
</script>
<?php
session_start();

var_dump($_POST, "\n\n");
echo nl2br("\n\n");

function Login()
{
    require_once('./dbconn.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM user WHERE email = '$email' AND user_password = '$password'";
    

    // echo "1";
    $result = $conn->query($query);
    print_r($result);
    
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);

    if ($count == 1) {
        echo nl2br("This is registered user\n\n");
        $_SESSION['useremail'] = $row['email'];
        $_SESSION['isLogin'] = 1;
        print_r($_SESSION['useremail']);
        echo nl2br("\n\n");
    } else {
        $error = "Your Login Name or Password is invalid";
        echo nl2br("Your Login Name or Password is invalid\n\n");
        header("location: ../signUp/loginPage.php");
    }

    $email = $row['email'];
    $sql = "SELECT user_id FROM user WHERE email = '$email'";
    $rs = mysqli_query($conn, $sql)
        or die(mysqli_error($conn));
    $row = mysqli_fetch_array($rs);
    $userid = $row['user_id'];

    print_r($_SESSION['user_id']);
    echo nl2br("\n\n");

    $query = "SELECT is_done FROM quarantine WHERE user_id = '$userid'";
    $result = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $quarantine_on = $row['is_done'];

    if ($quarantine_on == 1) {
        $query = "SELECT * FROM quarantine WHERE user_id = '$userid' AND is_done = 0";
        $result = mysqli_query($conn, $query)
            or die(mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        $start = $row['start_date'];
        $duration = $row['duration'];
        $qid = $row['quarantine_id'];
        $_SESSION['current_q'] = $qid;
    } else {
        $_SESSION['current_q'] = 0;
    }
    // header("location: ../index.php");

}


if (isset($_POST['submit'])) {
    Login();
}

?>
<script>
    location.reload();
</script>