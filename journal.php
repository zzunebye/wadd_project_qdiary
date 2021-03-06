<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./style/journal.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script defer async src="./controllers/geocode.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly"></script>



    <title>Journal</title>
    <style>
        div * {
            scrollbar-width: none;
            /* Firefox */
            -ms-overflow-style: none;

            /* IE 10+ */
            ::-webkit-scrollbar-track {
                -webkit-box-shadow: none !important;
                background-color: transparent;
            }

            ::-webkit-scrollbar {
                width: 3px !important;
                background-color: transparent;
            }

            ::-webkit-scrollbar-thumb {
                background-color: transparent;
            }

            .on-scrollbar {
                scrollbar-width: thin;
                /* Firefox */
                -ms-overflow-style: none;
                /* IE 10+ */
            }

            .on-scrollbar::-webkit-scrollbar-track {
                -webkit-box-shadow: none !important;
                background-color: transparent !important;
            }

            .on-scrollbar::-webkit-scrollbar {
                width: 6px !important;
                background-color: transparent;
            }

            .on-scrollbar::-webkit-scrollbar-thumb {
                background-color: #acacac;
            }
        }

        #map {
            height: 400px;
            width: 100%;
            /* visibility: hidden; */
        }

        .uk-container,
        .mapContainer {
            transform: translateX(120%);
            animation: movein 1S ease-in-out forwards;
        }

        @keyframes movein {
            0% {
                transform: translateX(120%);
            }

            100% {
                transform: translateX(0%);
            }
        }

        .inner-bar {
            transition: width 1.5s ease-in-out;
        }
    </style>
</head>

<?php

session_start();
require_once('./model/dbconn.php');
require_once('./model/qurantineTimeCal.php');
?>

<body>

    <div id="nav">
        <?php
        require("includes/header.php");
        ?>
    </div>

    <div class="progressContainer">
        <?php
        if ($_SESSION['current_q'] != 0) {
            echo
            '<h2>Quarantine Progress</h2>
                <div class="barContainer">
                    <span>0%</span>
                    <div class="bar">
                        <span class="percentage" id="percentage"></span>
                        <div class="inner-bar" id="inner-bar"></div>
                    </div>
                    <span>100%</span>
                </div>
                <h5>You have <span id="left"></span> days to go, Keep it up!</h5>
                </div>
                <div class="termContainer">
                    <div class="start">Start: <span class="startDate" id="startDate"></span></div>
                    <div class="rope">  </div>
                    <div class="end">End: <span class="endDate" id="endDate"></span></div>
                </div>';
        } else {
            echo '<h2>You have not started your Quarantine~!</h2>';
        }
        ?>

        <div id="timelineContainer" class="d-flex flex-column p-2 mb-4 mt-4 mx-auto rounded w-75 ">

            <div class="uk-container ">
                <div class="uk-timeline  border-start border-3 border-primary" id="uk-timeline">
                </div>
            </div>
        </div>
        <div class="mapContainer d-flex flex-column p-5 mb-4 mt-4 mx-auto rounded w-75 border rounded">
            <h5 id="text-center">Your Location ??????</h5>
            <input type="hidden" id="mapInput" value="<?php echo $_SESSION['cur_locale']; ?>">
            <hr>
            <div class="card-block mb-3" id="formatted-address"></div>
            <div class="card-block mb-3" id="geometry"></div>
            <div id="map"></div>

        </div>


        <script>
            document.getElementById("inner-bar").style.width = "<?php echo $percent; ?>%";
            document.getElementById("percentage").innerText = "<?php echo $percent; ?>%";
            document.getElementById("left").innerText = "<?php echo $left_days; ?>";
            document.getElementById("startDate").innerText = "<?php echo $start; ?>";
            document.getElementById("endDate").innerText = "<?php echo $end; ?>";

            function getRandomInt(max) {
                return Math.floor(Math.random() * Math.floor(max));
            }

            function difference(date1, date2) {
                const date1utc = Date.parse("date1");
                const date2utc = Date.parse("date2");
                date1utc = date1utc - date2utc;
                return round((date1utc) / (60 * 60 * 24));
            }
            $(document).ready(function() {
                $.ajax({
                    url: "http://<?php echo $hostname; ?>/wadd_project_qdiary/model/getcards.php",
                    type: "GET",
                    dataType: "json",
                    ContentType: "application/json",
                    success: function(response) {
                        response = JSON.stringify(response);
                    },
                    error: function(err) {
                        // alert(JSON.stringify(err));
                    }
                }).done(function(data) {

                    let card = ''

                    const cards = data.map((element, i) => {
                        const created = element['created_time'];
                        const card_title = element['card_title'];
                        const card_content = element['card_content'];
                        const picture = element['card_pic'];

                        const start = new Date("<?php echo $start; ?>");

                        const created_day = new Date(created.slice(0, 10));
                        const check = (picture == null) ? "none" : "inline-block";
                        const day = ((created_day - start) / 1000 / 60 / 60 / 24);
                        const newCard =
                            `
                        <div class="cardContainer" id="#list-item-${day+1}">
                            <div class="day">Day ${day+1}
                            <span class="created">${created.slice(0,10)}</span>
                            </div>
                            
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
                        const new_list_nav = `<a class="list-group-item list-group-item-action" href="#list-item-${day+1}">${day+1}</a>`

                    });
                    document.querySelectorAll('#list-item-')
                    document.getElementById("uk-timeline").innerHTML = card;

                });
            })

        </script>
</body>

</html>