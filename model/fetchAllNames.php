
<?php

session_start();


function fetchNames()
{
    require_once('./model/dbconn.php');
    
    $query = "SELECT first_name, last_name FROM user";
    
    $result = $conn->query($query);
    // print_r($result);
    // echo nl2br("\n\n");
    // echo($rs);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    return $row;
}


?>