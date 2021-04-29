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
        /* #map {
            height: 400px;
            width: 100%;
            visibility: hidden;
        } */
        #dataViewer {
            font-family: "Raleway", sans-serif;
            max-height: 300px;
            background: #373737;
            overflow-y: scroll;
            color: #fff;
            padding: 32px;
        }

        #dataViewer li {
            /* padding: 32px; */
            padding: 8px 0;
            border-left: 1px solid #635f5f;
            padding-left: 24px;
        }

        #dataViewer::-webkit-scrollbar {
            width: 3px;
            /* padding: 32px; */
            background: #101010;
        }

        #dataViewer::-webkit-scrollbar-thumb {
            /* padding: 32px; */
            background: #ffffff;
        }
    </style>


    <!-- <script defer async src="map.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require_once('./model/dbconn.php');
    $query = "SELECT first_name, last_name FROM user";
    $result = $conn->query($query);
    $count = mysqli_num_rows($result);
    $fetchedNames = $result->fetch_all(MYSQLI_ASSOC);
    var_dump($row);


    if ($_SESSION['isLogin'] && isset($_SESSION['useremail']) == true) {
        $welcomeMessage = "Welcome to the member's area, " . $_SESSION['firstname'] . "!";
    } else {
        header('Location: ./signUp/loginPage.php');
    }

    if ($_SESSION['current_q']) {
        $remindMessage = "You are on quarantine now";
    } else {
        $remindMessage = "Are you going to do quarantine soon?";
    }
    ?>
    <div id="wrapper">
        <div id="nav">
            <?php
            require("./includes/header.php");
            ?>
        </div>

        <div class="mb-4 mt-4 mx-auto  w-75 border border-primary">
            <p class="text-center "><?php echo ($welcomeMessage) ?></p>
            <p class="text-center "><?php echo ($remindMessage) ?></p>
        </div>

        <form action="model/search.php" class="d-flex flex-column p-2 mb-4 mt-4 mx-auto border border-primary border-radio rounded w-75">
            <div class="searchInputs input-group">
                <select class="col-2 form-control mr-2 container-sm" id="searchOptions" name="searchOptions">
                    <option>Name</option>
                    <option>Country</option>
                    <option>City</option>
                </select>
                <input class="form-control mr-1 col-10" type='text' name="searchBox" id="searchBox" placeholder="Type to search..." oninput=search(this.value) onfocusout=closeSearchResults()> <required>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>

            </div>
            <div class="searchResults">

                <ul id='dataViewer' class='list-unstyled my-0 py-0 overflow-scroll border'>
                    <?php foreach ($fetchedNames as $i) { ?>
                    <?php } ?>
                </ul>
                <!-- </form> -->
            </div>
        </form>

        <div class="mb-3">
            <?php
            // $db = new DB();
            // $data = $db->searchByName();
            // echo $data;
            $email = $_SESSION['useremail'];
            $sql = "SELECT user_id FROM user WHERE email = '$email'";
            $rs = mysqli_query($conn, $sql)
                or die(mysqli_error($conn));
            $row = mysqli_fetch_array($rs);
            $userid = $row['user_id'];

            $query = "SELECT is_done FROM quarantine WHERE user_id = '$userid'";
            $result = mysqli_query($conn, $query)
                or die(mysqli_error($conn));
            $row = mysqli_fetch_array($result);
            $quarantine_on = $row['is_done'];


            if ($quarantine_on == NULL) {
                require("includes/addingJourney.php");
            } else if ($quarantine_on == 0) {
                require("includes/addingCard.php");
            } else {
                require("includes/addingJourney.php");
            }
            ?>

        </div>

    </div>
    <!-- <script defer async src="./controllers/geocode.js"></script> -->
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly"> -->
    <!-- </script> -->

    <script>
        function search(name) {
            const optionValue = document.getElementById('searchOptions').value 
            console.log(name);
            console.log(optionValue);
            fetchSearchData(name, optionValue);
        }

        function fetchSearchData(name, optionValue) {
            fetch('./model/search.php', {
                    method: 'POST',
                    body: new URLSearchParams('name=' + name,'option='+optionValue)
                })
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    viewSearcResult(res);
                })
                .catch(e => console.error('Error: ' + e))
        }

        function viewSearcResult(data) {
            const dataViewer = document.getElementById('dataViewer')
            dataViewer.innerHTML = ""

            for (let i = 0; i < data.length; i++) {
                let li = document.createElement("li");

                li.innerHTML = data[i]['full_name'];
                dataViewer.appendChild(li);
            }
        }

        function closeSearchResults() {
            const dataViewer = document.getElementById('dataViewer')
            dataViewer.innerHTML = ""
        }

    </script>

</body>

</html>