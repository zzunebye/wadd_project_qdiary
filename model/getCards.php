<?php
require_once('./dbconn.php');
session_start();

$qid = $_SESSION['current_q'];

$query = "SELECT * FROM card WHERE quarantine_id = '$qid' ";
$result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));

$count = mysqli_num_rows($result);

if ($count > 0) {
   
    $dbdata = array();

   
    while ($row = $result->fetch_assoc()) {
        $dbdata[] = $row;
    }

    
    echo json_encode($dbdata);
} else {
    echo "Invalid format";
}

