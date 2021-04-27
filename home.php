<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">


    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
            visibility: hidden;
        }
    </style>


    <script defer async src="map.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['isLogin'] && isset($_SESSION['useremail']) == true) {
        $welcomeMessage = "Welcome to the member's area, " . $_SESSION['firstname'] . "!";
    } else {
        header('Location: ./signUp/loginPage.php');
    }
    ?>
    <div id="wrapper">
        <div id="nav">
            <?php
            require("./includes/header.php");
            ?>
        </div>

        <div class="mb-4 mt-4 mx-auto  w-75">
            <p class="text-center "><?php echo($welcomeMessage) ?></p>
        </div>

        <div class="input-group p-2 mb-4 mt-4 mx-auto border border-primary border-radio rounded w-75">
            <input class="form-control mr-1" list="datalistOptions" id="exampleDataList" placeholder="Type to search..." required>
            <datalist id="datalistOptions">
                <option value="San Francisco">
                <option value="New York">
                <option value="Seattle">
                <option value="Los Angeles">
                <option value="Hong Kong">
                <option value="Chicago">
            </datalist>
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            <!-- </form> -->
        </div>

        <div class="mb-3">
            <?php
                require_once('./model/dbconn.php');
                $email = $_SESSION['useremail'];
                $sql = "SELECT user_id FROM user WHERE email = '$email'";
                $rs=mysqli_query($conn,$sql)
			        or die(mysqli_error($conn));
                $row = mysqli_fetch_array($rs);
                $userid = $row['user_id'];

                $query = "SELECT is_done FROM quarantine WHERE user_id = '$userid'";
                $result=mysqli_query($conn,$query)
			        or die(mysqli_error($conn));
                $row = mysqli_fetch_array($result);
                $quarantine_on = $row['is_done'];
                

                if($quarantine_on == NULL){
                    require("includes/addingJourney.php");
                }else if ($quarantine_on == 0){
                    require("includes/addingCard.php");
                }else{
                    require("includes/addingJourney.php");
                }
            ?>
            
        </div>

    </div>
    <script defer async src="./controllers/geocode.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly">
    </script>


</body>

</html>