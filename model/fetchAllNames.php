
<?php

session_start();
// echo "fetchNames.php";


// // SELECT IF(ISNULL(firstname), lastname, CONCAT(firstname, ' ', lastname)) AS fullname FROM users
// // $query = "SELECT * FROM card WHERE quarantine_id = '$qid' ";
// // $result = mysqli_query($conn, $query)
// //     or die(mysqli_error($conn));
// // $row = mysqli_fetch_array($result);

function fetchNames()
{
    require_once('./model/dbconn.php');
    // var_dump($conn);
    $query = "SELECT first_name, last_name FROM user";
    // $query = "SELECT CONCAT(first_name, ' ', last_name)) AS full_name FROM user";
    // $query = "SELECT * IF(ISNULL(first_name), last_name, CONCAT(first_name, ' ', last_name)) AS full_name FROM user";
    $result = $conn->query($query);
    // print_r($result);
    // echo nl2br("\n\n");
    // echo($rs);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    return $row;
}
// $result = searchByName();
// // echo nl2br("\n\n");
// // var_dump($result);

// return $result;

?>