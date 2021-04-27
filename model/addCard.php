<?php
    session_start();
    require_once('./dbconn.php');
    $content = $_POST['thought'];
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date('Y-m-d h:i:s');
    
    $email = $_SESSION['useremail'];
    // echo $email;
    // get current user id
    $sql = "SELECT user_id FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $userid = $row['user_id'];

    //get current quarantine id
    $sql = "SELECT * FROM quarantine WHERE user_id = '$userid'";
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $quarantine_id = $row['quarantine_id'];
    // echo $quarantine_id; 

    $query = "INSERT INTO card (card_content, quarantine_id, created_time) 
    VALUES ('$content','$quarantine_id','$date')";
    $rs = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    header("location: ../home.php");
?>