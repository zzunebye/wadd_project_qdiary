
<?php

session_start();
// echo "search.php";

function searchByName()
{
    require_once('./dbconn.php');
    $name = $_POST['name'];
    $option = $_POST['option'];

    if ($option == 'Name') {
        # code...
        $query = "SELECT first_name, last_name, user_id ,CONCAT(first_name, ' ', last_name) AS full_name FROM user WHERE CONCAT(first_name, ' ', last_name) LIKE '%$name%'";
        // $query = "SELECT * IF(ISNULL(first_name), last_name, CONCAT(first_name, ' ', last_name)) AS full_name FROM user";
        $result = $conn->query($query);

        $count = mysqli_num_rows($result);

        //Initialize array variable
        $dbdata = array();

        if ($count > 0) {
            //Fetch into associative array
            while ($row = $result->fetch_assoc()) {
                $dbdata[] = $row;
            }
            echo json_encode($dbdata);
        } else {
            echo json_encode("");
        }
    } else if ($option == 'Location') {
        $query = "SELECT DISTINCT country, city ,CONCAT(city, ', ', country) AS locale FROM quarantine WHERE CONCAT(city, ', ', country) LIKE '%$name%'";
        $result = $conn->query($query);

        $count = mysqli_num_rows($result);

        //Initialize array variable
        $dbdata = array();

        if ($count > 0) {
            //Fetch into associative array
            while ($row = $result->fetch_assoc()) {
                $dbdata[] = $row;
            }
            echo json_encode($dbdata);
        } else {
            echo json_encode("");
        }
    }


   
}
searchByName();


?>