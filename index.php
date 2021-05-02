<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/journal.css" />
    <link rel="stylesheet" href="./style/home.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <style>
        body {
            height: 100vh;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        body::-webkit-scrollbar {
            display: none;
            font-family: "Karla", sans-serif;
        }
        h2{
            font-family: 'Karla', sans-serif;
        }
        .card.cardQuar {
            cursor: pointer;
        }

        .card.cardQuar:hover {

            transform: scale(1.05)
        }
        .cardContainer {
            display: flex;
            align-items: center;
            /* width: 300px; */
        }

        #dataViewer {
            font-family: "Raleway", sans-serif;
            max-height: 300px;
            background: #283b42;
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
            background: #101010;
        }

        #dataViewer::-webkit-scrollbar-thumb {
            background: #ffffff;
        }
        .welcome{
            border-bottom: 3px solid #b6cad8;
        }
        .welcome :first-child{
            font-size: 30px;
        }
        .afterSearch{
            display: none;
        }
        .afterSearch.show{
            display: block;
        }
        .adding.hidden{
            display: none;
        }
        button{
            transition: 0.5s;
            width: 120px;
            height: 40px;
        }
        button:hover{
            color: #fff;
            transform: scale(1.01);
        }
    </style>


    <!-- <script defer async src="map.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Q-diary</title>
</head>

<body>
    <?php
    session_start();
    require_once('./model/dbconn.php');
    $query = "SELECT first_name, last_name FROM user";
    $result = $conn->query($query);
    $count = mysqli_num_rows($result);
    $fetchedNames = $result->fetch_all(MYSQLI_ASSOC);
    // var_dump($row);


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
    
        <div id="nav">
            <?php
            require("./includes/header.php");
            ?>
        </div>

        <div class="mb-4 mt-4 mx-auto  w-75 welcome">
            <p class="text-center "><?php echo ($welcomeMessage) ?></p>
            <p class="text-center "><?php echo ($remindMessage) ?></p>
        </div>

        <form action="model/search.php" class="d-flex flex-column p-2 mb-4 mt-4 mx-auto  rounded w-75">
            <div class="searchInputs input-group">
                <select class="col-2 form-control mr-2 container-sm" id="searchOptions" name="searchOptions">
                    <option>Name</option>
                    <option>Location</option>
                </select>
                <input class="form-control mr-1 col-10" type='text' name="searchBox" id="searchBox" placeholder="Type to search..." oninput=search(this.value) onfocus=closeSearchResults() autocomplete="off">
                <required>
                    <!-- <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button> -->

            </div>
            <div class="searchResults">

                <ul id='dataViewer' class='list-unstyled my-0 py-0 overflow-scroll '>

                </ul>

            </div>
        </form>

        <div class="mt-2 mb-4 d-flex p-2 mx-auto flex-column justify-content-center w-75 px-5">
            <div class="afterSearch" id="searchBoxs" style="position: relative;">
                <h2 class=" text-center b5">Search Result</h2>
                <button id="button" style="border: 0; outline:0; background-color:#85b8cb; border-radius: 10px;
                position: absolute;
                top: 0; right:0;">Hide Results</button>
            </div>
            <div class="mb-3" id="searchResults">

            </div>
            <div id="timelineContainer" class="d-flex flex-column p-1 mb-2 mt-1 mx-auto rounded w-100 ">

                <div class="uk-container uk-padding afterSearch" id="searchBoxss">
                    <div class="uk-timeline  ps-3 " id="uk-timeline">
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3 adding" id="adding">
            <?php
         
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

            // echo $_SESSION['current_q']; 
            if ($_SESSION['current_q']==0) {
                require("includes/addingJourney.php");
            } else if ($_SESSION['current_q'] > 0) {
                require("includes/addingCard.php");
            } else {
                require("includes/addingJourney.php");
            }
            ?>

        </div>



    <script>
        document.getElementById('button').addEventListener('click', () => {
            document.getElementById('searchBoxss').classList.remove("show");
            document.getElementById('searchBoxs').classList.remove("show");
            document.getElementById('adding').classList.remove("hidden");
            
        });
        // document.getElementById('searchBox').addEventListener()
        function search(name) {
            const optionValue = document.getElementById('searchOptions').value
            fetchSearchData(name, optionValue);
        }

        function fetchSearchData(name, optionValue) {

            const body = new URLSearchParams();
            fetch('./model/search.php', {
                    method: 'POST',
                    body: new URLSearchParams('name=' + name + '&option=' + optionValue)
                })
                .then(res => res.json())
                .then(res => {
                    console.log(res);
                    viewSearchResult(res, optionValue);
                })
                .catch(e => console.error('Error: ' + e))
        }

        function viewSearchResult(data, optionValue) {
            const dataViewer = document.getElementById('dataViewer')
            dataViewer.innerHTML = ""
            

            if (optionValue == 'Name') {
                for (let i = 0; i < data.length; i++) {
                    const searchBox = document.getElementById('searchBox')
                    let li = document.createElement("li");

                    li.classList.add("searchItem");
                    li.style.cursor = "pointer"

                    console.log("full:", data[i]['full_name']);
                    li.innerHTML = data[i]['full_name'];
                    li.value = data[i]['user_id'];

                    li.addEventListener('click', function() {
                        const searchBox = document.getElementById('searchBox')
                        const dataViewer = document.getElementById('dataViewer')
                        document.getElementById('searchBoxs').classList.add("show");
                        document.getElementById('searchBoxss').classList.add("show");
                        document.getElementById('adding').classList.add("hidden");
                        dataViewer.innerHTML = ""
                        searchBox.value = this.innerText;
                        fetchItemInfo(this.innerText, this.value, optionValue)
                    }, false);

                    li.addEventListener("mouseover", function(event) {
                        event.target.style.color = "orange";
                    }, false);

                    li.addEventListener("mouseout", function(event) {
                        event.target.style.color = "";

                    }, false);

                    dataViewer.appendChild(li);
                }

            } else if (optionValue == 'Location') {
                for (let i = 0; i < data.length; i++) {
                    const searchBox = document.getElementById('searchBox')
                    let li = document.createElement("li");

                    li.classList.add("searchItem");
                    li.style.cursor = "pointer"

                    console.log("city:", data[i]['locale']);
                    li.innerHTML = data[i]['locale'];
                    li.value = data[i]['locale'];

                    li.addEventListener('click', function() {
                        const searchBox = document.getElementById('searchBox')
                        const dataViewer = document.getElementById('dataViewer')
                        document.getElementById('searchBoxs').classList.add("show");
                        document.getElementById('searchBoxss').classList.add("show");
                        document.getElementById('adding').classList.add("hidden");
                        dataViewer.innerHTML = ""
                        console.log("clicked:", this.innerText);
                        searchBox.value = this.innerText;
                        fetchItemInfo(this.innerText, this.value, optionValue)
                    }, false);


                    li.addEventListener("mouseover", function(event) {
                        event.target.style.color = "orange";
                    }, false);

                    li.addEventListener("mouseout", function(event) {
                        event.target.style.color = "";

                    }, false);

                    dataViewer.appendChild(li);
                }
            }
        }

        function fetchItemInfo(value, id, option) {
            // console.log(option, ">", value, ">", id);
            if (option == name) {
                const result = value
            }

            const body = new URLSearchParams();
            if (option == "Name") {
                fetch('./model/getUserQurantinePeeks.php', {
                        method: 'POST',
                        body: new URLSearchParams('name=' + value + '&id=' + id + '&option=' + option)
                    })
                    .then(res => res.json())
                    .then(data => {
                        // console.log("data:", data);
                        let card = ''

                        const cards = data.map((element) => {
                            const created = element['created_time']
                            const card_title = element['card_title']
                            const card_content = element['card_content']
                            const picture = element['card_pic'];
                            const check = (picture == null || picture == "") ? "none" : "inline-block";
                            const newCard =
                                `
                                <div class="cardContainer">
                            
                            
                                <div class="card mb-4 shadow ">
                                    <div class="card-header ">
                                        ${created.slice(-9)}
                                    </div>
                                    <div class="card-body">
                                        <div style="width: 100%; height: 100%;">
                                        <h5 class="card-title">${card_title}</h5>
                                        <p class="card-text">${card_content}</p>
                                        </div>
                                    
                                    </div>
                                </div>
                                <div class="picture" id="picture" 
                                        style="background-image: url('images/${picture}'); display: ${check}">
                                        
                                    </div>
                        </div>
                            `
                            card = card + newCard
                            // return text;
                        });
                        document.getElementById("uk-timeline").innerHTML = card;
                    })
                    .catch(e => console.error('Error: ' + e))
            } else if (option == "Location") {
                fetch('./model/getUserQurantinePeeks.php', {
                        method: 'POST',
                        body: new URLSearchParams('name=' + value + '&id=' + id + '&option=' + option)
                    })
                    .then(res => res.json())
                    .then(data => {
                        console.log("data:", data);
                        let card = ''

                        const cards = data.map((element) => {
                            const locale = element['locale'];
                            const end_date = element['end_date'];
                            const start_date = element['start_date'];
                            const description = element['description'];
                            const user_id = element['userid'];
                            const full_name = element['full_name']
                            const quarantine_id = element['quarantine_id']
                            const newCard =
                                `
                                <div class="card cardQuar mb-4 shadow round" data-qid="${quarantine_id}">
                                    <div class="card-header "style="background-color:#d1dddb">
                                        ${locale}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">${start_date} ➡ ${end_date}, <i>by ${full_name}</i></h5>
                                        <p class="card-text">${description}</p>
                                    </div>
                                </div>
                            `
                            card = card + newCard

                            // return text;
                        });
                        document.getElementById("uk-timeline").innerHTML = card;
                        // document.querySelectorAll(".card.cardQuar");

                    }).then(() => {
                        console.log(Array.from(document.querySelectorAll('.cardQuar')));
                        Array.from(document.querySelectorAll('.cardQuar')).map((e) => {
                            e.onclick = function() {
                                const qid = e.getAttribute("data-qid");
                                // console.log(e.getAttribute("data-qid"));
                            };
                            // e.addEventListener("click", function(e) {
                            // }, false);
                        });

                    })
                    .catch(e => console.error('Error: ' + e))
            }
        }

        function closeSearchResults() {
            const dataViewer = document.getElementById('dataViewer')
            const searchBox = document.getElementById('searchBox')
            searchBox.value = "";
            dataViewer.innerHTML = ""
            
        }
    </script>

</body>

</html>