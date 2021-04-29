<?php
require_once('./dbconn.php');
session_start();

$value = $_POST['name'];
$uid = $_POST['id'];
$option = $_POST['option'];

// $value = 'Seoul, South Korea';
// $uid = 0;
// $option = "Location";

function getQid($uid, $conn)
{
    // $query = "SELECT c.*, q.quarantine_id FROM quarantine q LEFT JOIN card c on c.quarantine_id = q.quarantine_id WHERE user_id = '$uid'";
    $query = "SELECT * FROM card WHERE quarantine_id = '$qid'";

    // $query = "SELECT q.quarantine_id, q.start_date, q.end_date, q.user_id, q.description, CONCAT(user.first_name, ' ', user.last_name) AS full_name, CONCAT(q.city, ', ', q.country) AS locale FROM quarantine q LEFT JOIN user on user.user_id  = q.user_id WHERE CONCAT(city, ', ', country) LIKE '$value'";

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
        return $dbdata;
    } else {
        echo "Invalid format";
    }
}

function caseName($uid, $conn)
{
    // $qids = getQid($uid, $conn);
    $query = "SELECT c.*, q.quarantine_id FROM quarantine q INNER JOIN card c on c.quarantine_id = q.quarantine_id WHERE user_id = '$uid'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);
        $cardArray = array();

    if ($count > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $cardArray[] = $row;
        }
        echo json_encode($cardArray);
    } else {
        echo "no results found";
    }

    // for ($i = 0; $i < count($qids); $i++) {
    //     //     // $query = "SELECT quarantine_id FROM quarantine WHERE user_id = '$uid'";
    //     // echo '<p>' . $qids[$i]['quarantine_id'] . '</p>';
    //     $qid = $qids[$i]['quarantine_id'];

    //     // print_r($qids);
    //     //     $qid = $qids[$i];
    //     $cardArray = array();

    //     $query = "SELECT * FROM card WHERE quarantine_id = '$qid'";
    //     $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    //     $count = mysqli_num_rows($result);

    //     if ($count > 0) {
    //         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    //             $cardArray[] = $row;
    //         }
    //         echo json_encode($cardArray);
    //     } else {
    //         echo "no results found";
    //     }
    // }
}


function caseLocation($value, $conn)
{
    // $query = "SELECT quarantine_id FROM quarantine WHERE user_id = '$uid'";
    $query = "SELECT q.quarantine_id, q.start_date, q.end_date, q.user_id, q.description, CONCAT(user.first_name, ' ', user.last_name) AS full_name, CONCAT(q.city, ', ', q.country) AS locale FROM quarantine q LEFT JOIN user on user.user_id  = q.user_id WHERE CONCAT(city, ', ', country) LIKE '$value'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($result);

    // echo '<p>' . $count . '</p>';

    if ($count > 0) {
        //Initialize array variable
        $qArray = array();

        //Fetch into associative array
        while ($row = $result->fetch_assoc()) {
            $qArray[] = $row;
        }
        //Print array in JSON format
        // echo '<p>' . var_dump($qData) . '</p>';
        echo json_encode($qArray);

        // return $qArray;
    } else {
        echo "Invalid format";
    }
}


if ($option == 'Name') {
    caseName($uid, $conn);
} else if ($option == 'Location') {
    caseLocation($value, $conn);
}
