<!DOCTYPE html>
<html>

<head></head>

<body>
    <?php
    session_start(); ?>
    <p>city: <?php echo $_POST["city"]; ?></p>
    <p>duration: <?php echo $_POST["duration"]; ?></p>
    <p>startDate: <?php echo $_POST["startDate"]; ?></p>
    <p>description: <?php echo $_POST["description"]; ?></p>
</body>

</html>


<script>
    console.log("addQurantine PAGE")
</script>
<?php
var_dump($_POST, "\n\n");
echo nl2br("\n\n");
function addQuarantine()
{
    echo nl2br("addQuarantine()\n\n");
    require_once('./dbconn.php');
    $hostname = "localhost";
    $database  = "waddproject";
    $username = "root";
    $password  = "";
    // $dbconn = new PDO('mysql:host='.$hostname.';dbname='.$database, $username, $password);
    $city = $_POST['city'];
    $country = $_POST['country'];
    $duration = $_POST['duration'];
    $startDate = $_POST['startDate'];
    $description = $_POST['description'];
    $email = $_SESSION['useremail'];
    // $query = "INSERT INTO quarantine (first_name, last_name, email, user_password) VALUES ('$firstname','$lastname','$email','$password')";

    $sql = "SELECT user_id FROM user WHERE email = '$email'";
    echo ($sql);
    echo nl2br("\n\n");
    $result = $conn->query($sql);

    var_dump($result);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    // echo ($stmt->param_count);
    // echo nl2br("\n\n");
    // $result = $conn->query($sql);
    echo ($row);
    echo nl2br("\n\n");
    if ($count == 1) {
        echo nl2br("This is registered user\n\n");
        $userid = $row['user_id'];
        // $_SESSION['isLogin'] = 1;
        print_r("userid:" . $userid);
        echo nl2br("\n\n");
        $sql = "INSERT INTO quarantine (first_name, last_name, email, user_password) VALUES ('$city','$country','$duration','$startDate','$userid')";
        echo ($sql);
        echo nl2br("\n\n");

        // header("location: ../home.php");
    } else {
        // $error = "Your Login Name or Password is invalid";
        // echo nl2br("Your Login Name or Password is invalid\n\n");
        // header("location: ../signUp/loginPage.php");
    }

    // $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    // $sql = ("SELECT UserID FROM USERS WHERE Email = '" . $_SESSION['useremail'] . "'");
    // $result = $db->query($sql);
    // $row = mysqli_fetch_array($result);
    // $userid = intval($row['UserID']);
    // $fee = intval($fee);
    // $_SESSION['userid'] = $userid;
    // $sql = ("set foreign_key_checks=0");
    // $result = $db->query($sql);
    // $sql = ("INSERT INTO ITINERARY (UserID,DateTimeStart,DateTimeEnd,EventID,BookingFee,EventName) VALUES ($userid, '" . $_SESSION['daytime1'] . "', '" . $_SESSION['daytime2'] . "', '$eventid', $fee, '$eventname')");


    //     $rs = mysqli_query($conn, $query)
    //         or die(mysqli_error($conn));

    //     echo ($query);
    //     echo nl2br("\n\n");

    //     // echo "1";
    //     $result = $conn->query($query);
    //     print_r($result);
    //     echo nl2br("\n\n");
    //     // echo($rs);
    //     $count = mysqli_num_rows($result);
    //     $row = mysqli_fetch_array($result);

    //     if ($count == 1) {
    //         echo nl2br("This is registered user\n\n");
    //         $_SESSION['useremail'] = $row['email'];
    //         $_SESSION['isLogin'] = 1;
    //         // print_r($_SESSION['useremail']);
    //         // echo nl2br("\n\n");

    //         header("location: ../home.php");
    //     } else {
    //         $error = "Your Login Name or Password is invalid";
    //         // echo nl2br("Your Login Name or Password is invalid\n\n");
    //         // header("location: ../signUp/loginPage.php");
    //     }
}


if (isset($_POST['submit'])) {
    addQuarantine();
}

?>
<script>
    // location.reload();
</script>