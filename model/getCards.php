<?php
require_once('./dbconn.php');
session_start();

$qid = $_SESSION['current_q'];

$query = "SELECT * FROM card WHERE quarantine_id = '$qid' ";
$result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));
// $row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

if ($count > 0) {
    // $cards=array();
    // while($card=mysql_fetch_array($result)){
    // $cards[]=array('User'=>$recipe);
    // }
    // $output = json_encode($row);
    // // echo $count;
    // echo $output;



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

// $index = $_GET['index'];

// $desc = ['Best Friend', 'Favorite Language', 'Best Musician'];
// $name = ['Aram Kim', 'Python', 'IU'];

// $json = json_encode(array('desc' => $desc[0], 'name' => $name[0]));

// echo ($json);

// echo $row
