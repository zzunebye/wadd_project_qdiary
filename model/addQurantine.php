<?php
session_start();
function getduration($duration_days){
    switch($duration_days){
        case "7 Days":
            $duration_days = 7;
            break;
        case "10 Days":
            $duration_days = 10;
            break;
        case "2 Weeks":
            $duration_days = 14;
            break;
        case "3 Weeks":
            $duration_days = 21;
            break;
    }
    return $duration_days;
}

function getEndDate($start, $durations){
    echo nl2br("\n\n");
    // echo $duration;
    echo nl2br("\n\n");
    $duration_days = getduration($durations);
    $year = substr($start, 0,4);
    $days = substr($start, -2);
    $month =  substr($start, -5,-3);
    // calculate enddate
    if($days + $duration_days > 28){
        if($month == 2){
            $month++;
            $days = $days + $duration_days - 28;
            
        }else if($days + $duration_days > 30){
            if($month == 4 || $month == 6 || $month == 9 || $month == 11){
                $month++;
                $days = $days + $duration_days - 30;
            }else{
                if($days + $duration_days > 31){
                    if($month == 12){
                        $year++;
                        $month = 1;
                    }else{
                        $month++;
                    }
                    $days = $days + $duration_days - 31;
                }
            }
        }
    }
    ////////
    $month = (strlen($month) == 1) ? "0".$month : $month;
    $days = (strlen($days) == 1) ? "0".$days : $days;
    $enddate = $year."-".$month."-".$days;
    
    return $enddate;
}

function addQuarantine()
{
    // echo nl2br("addQuarantine()\n\n");
    require_once('./dbconn.php');
    
    $city = $_POST['city'];
    $country = $_POST['country'];
    $duration = $_POST['duration'];
    $startDate = $_POST['startDate'];
    $description = $_POST['description'];
    $email = $_SESSION['useremail'];
    
    $enddates = getEndDate($startDate, $duration);
    $duration = getduration($duration);
    // echo $duration;
    $sql = "SELECT user_id FROM user WHERE email = '$email'";
    
    $result = $conn->query($sql);
    
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
   
    
        
    $userid = $row['user_id'];
        
    $query = "INSERT INTO quarantine (user_id, country, start_date, end_date, is_done, city, description, duration) 
    VALUES ('$userid','$country','$startDate','$enddates', '0', '$city', '$description', '$duration')";
    $rs = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    $query = "SELECT * FROM quarantine WHERE user_id = '$userid' AND is_done = 0";
    $result = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $start = $row['start_date'];
    $duration = $row['duration'];
    $qid = $row['quarantine_id'];
    $_SESSION['current_q'] = $row['quarantine_id'];
    header("location: ../index.php");
    
}


if (isset($_POST['submit'])) {
    addQuarantine();
}

?>
<script>
    // location.reload();
</script>