<?php
$email = $_SESSION['useremail'];
$sql = "SELECT user_id FROM user WHERE email = '$email'";
$rs = mysqli_query($conn, $sql)
    or die(mysqli_error($conn));
$row = mysqli_fetch_array($rs);
$userid = $row['user_id'];
if ($_SESSION['current_q'] != 0) {
    $query = "SELECT *, CONCAT(city, ', ', country) AS locale FROM quarantine WHERE user_id = '$userid' AND is_done = 0";
    $result = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $start = $row['start_date'];
    $end = $row['end_date'];
    $duration = $row['duration'];
    $locale = $row['locale'];
    $_SESSION['cur_locale'] = $locale;
    $qid = $row['quarantine_id'];
    date_default_timezone_set("Asia/Hong_Kong");
    $current_date = date('Y-m-d');
    $current_qid = $_SESSION['current_q'];
    // echo $current_qid;
    if ($start <= $current_date) {
        $diff = abs(strtotime($start) - strtotime($current_date));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

        if ($days > $duration) {
            $query = "UPDATE quarantine SET is_done = '1' WHERE quarantine_id = '$current_qid'";
            $result = mysqli_query($conn, $query)
                or die(mysqli_error($conn));
            $_SESSION['current_q'] = 0;
        } else {
            $percent = floor(($days) / $duration * 100);
            $left_days = $duration -  $days;
        }
    }
}


?>
<script>
    // location.reload();
</script>