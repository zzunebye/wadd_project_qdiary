<?php
    session_start();
    require_once('./dbconn.php');
    $content = $_POST['thought'];
    $title = $_POST['title'];
    $target = "../images/".basename($_FILES['image']['name']);
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date('Y-m-d h:i:s');
    $image = $_FILES['image']['name'];
    $email = $_SESSION['useremail'];
    // echo $email;
    // get current user id
    $sql = "SELECT user_id FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $userid = $row['user_id'];

    //get current quarantine id
    $sql = "SELECT * FROM quarantine WHERE user_id = '$userid' AND is_done = '0'";
    $result = $conn->query($sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    $quarantine_id = $row['quarantine_id'];
    // echo $quarantine_id; 

    $query = "INSERT INTO card (card_content, quarantine_id, created_time, card_title, card_pic) 
    VALUES ('$content','$quarantine_id','$date', '$title', '$image')";
    $rs = mysqli_query($conn, $query)
        or die(mysqli_error($conn));

    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
        $msg = "uploaded";
    }else{
        $msg = "upload failed";
    }
    header("location: ../journal.php");
?>