<?php
require_once('./dbconn.php');
session_start();

$qid = $_SESSION['current_q'];
// echo $qid;
$query = "SELECT * FROM card WHERE quarantine_id = '$qid' ";
$result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));

$count = mysqli_num_rows($result);

if ($count > 0) {
    //Initialize array variable
    $dbdata = array();

    //Fetch into associative array
    while ($row = $result->fetch_assoc()) {
        $dbdata[] = $row;
    }

    //Print array in JSON format
    echo json_encode($dbdata);
} else {
    echo "Invalid format";
}

