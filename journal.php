<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/journal.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

    <title>Journal</title>
</head>
<?php
require_once('./model/dbconn.php');
session_start();
$email = $_SESSION['useremail'];
$sql = "SELECT user_id FROM user WHERE email = '$email'";
$rs = mysqli_query($conn, $sql)
    or die(mysqli_error($conn));
$row = mysqli_fetch_array($rs);
$userid = $row['user_id'];

$query = "SELECT * FROM quarantine WHERE user_id = '$userid' AND is_done = 0";
$result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$start = $row['start_date'];
$duration = $row['duration'];
$qid = $row['quarantine_id'];
date_default_timezone_set("Asia/Hong_Kong");
$current_date = date('Y-m-d');

$diff = abs(strtotime($start) - strtotime($current_date));

$years = floor($diff / (365 * 60 * 60 * 24));
$monthds = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
$days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
// echo $days;

$percent = floor($days / $duration * 100);
$left_days = $duration -  $days + 1;
$percent;
// echo $percent;

$qid = $_SESSION['current_q'];

$query = "SELECT * FROM card WHERE quarantine_id = '$qid' ";
$result = mysqli_query($conn, $query)
    or die(mysqli_error($conn));
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);


for ($x = 0; $x < $count; $x++) {
    echo "asdfasdf  ";
}


var_dump($_SESSION['current_q']);
echo nl2br("\n\n");
var_dump($result);
echo nl2br("\n\n");

var_dump($row);
echo nl2br("\n\n");
echo ($count);





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
                <div class="inner-bar" id="inner-bar"></div>
            </div>
            <span>100%</span>
        </div>
        <h5>You have <span id="left"></span> days to go, Keep it up!</h5>
    </div>
    <div class="timelineContainer">

        <div class="uk-container uk-padding">
            <div class="uk-timeline">
            </div>
        </div>
    </div>
    <script>
        document.getElementById("inner-bar").style.width = "<?php echo $percent; ?>%";
        document.getElementById("inner-bar").innerText = "<?php echo $percent; ?>%";
        document.getElementById("left").innerText = "<?php echo $left_days; ?>";
    </script>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // alert("1");
        // alert("2");
        $.ajax({
            url: "http://localhost/wadd_project/model/getCards.php",
            type: "GET",
            dataType: "json",
            ContentType: "application/json",
            success: function(response) {
                console.log(response);
                response = JSON.stringify(response);
                console.log(response);
            },
            error: function(err) {
                alert(JSON.stringify(err));
            }
        }).done(function(data) {
            // $('#result').text(data);
            console.log(data);
            const card = ''
            data.forEach(element => {
                console.log(element);
                console.log(element['created_time']);
                card += ```
                <div class="uk-timeline-item">
                    <div class="uk-timeline-icon">
                        <span class="uk-badge"><span uk-icon="check"></span></span>
                    </div>
                    <div class="uk-timeline-content">
                        <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <h3 class="uk-card-title"><time datetime="2020-07-08">July 8</time></h3>
                                    <span class="uk-label uk-label-success uk-margin-auto-left">Feature</span>
                                </div>
                            </div>
                            <div class="uk-card-body">
                                <p class="uk-text-success">Fully responsive timeline you can add to your UIkit 3 project
                                </p>
                            </div>
                        </div>
                    </div>
                </div>```


            });
        });
    });
</script>

</html>