<?php

function getRecordedDates()
{
    // echo nl2br("addQuarantine()\n\n");
    require_once('./dbconn.php');
    $qid = $_SESSION['current_q'];

    $query = "SELECT * FROM card WHERE quarantine_id = '$qid' ";
    $result = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);

    // return $row;
   
    // header("location: ../home.php");
}


getRecordedDates();
