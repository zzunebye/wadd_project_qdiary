<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/journal.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    
    <title>Journal</title>
</head>
<?php
     require_once('./model/dbconn.php');
     session_start();
     $email = $_SESSION['useremail'];
     $sql = "SELECT user_id FROM user WHERE email = '$email'";
     $rs=mysqli_query($conn,$sql)
         or die(mysqli_error($conn));
     $row = mysqli_fetch_array($rs);
     $userid = $row['user_id'];

     $query = "SELECT * FROM quarantine WHERE user_id = '$userid' AND is_done = 0";
     $result=mysqli_query($conn,$query)
         or die(mysqli_error($conn));
     $row = mysqli_fetch_array($result);
     $start = $row['start_date'];
     $duration = $row['duration'];
     date_default_timezone_set("Asia/Hong_Kong");
     $current_date = date('Y-m-d');

    $diff = abs(strtotime($start) - strtotime($current_date));

    $years = floor($diff / (365*60*60*24));
    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

    $percent = floor($days/$duration * 100);
    $left_days = $duration -  $days;
    $percent;
    // echo $percent;
?>
<body>
    <div id="header-container">
        <div id="nav">
            <?php
            require("includes/header.php");
            ?>

        </div>
    </div>
    <div class="progressContainer">
            <h2>Quarantine Progress</h2>
            <div class="barContainer">
                <span>0%</span>
                <div class="bar">
                    <div class="inner-bar" id="inner-bar">60%</div>
                </div>
                <span>100%</span>
            </div>
            <h5>You have <span id="left"></span> days to go, Keep it up!</h3>

    <div>
    <script>
        document.getElementById("inner-bar").style.width = "<?php echo $percent; ?>%";
        document.getElementById("inner-bar").innerText = "<?php echo $percent; ?>%";
        document.getElementById("left").innerText = "<?php echo $left_days; ?>";
    </script>
</body>
    
</html>