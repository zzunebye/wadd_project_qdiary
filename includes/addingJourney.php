<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">


    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <title>Document</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
            visibility: hidden;
        }
    </style>
</head>

<body>
    <div id="addingJourney" class="d-flex m-auto flex-column justify-content-center w-75 px-5 border border-primary">
        <h2 id="text-center">Enter Location: </h2>
        <form class="" id="location-form">
            <input type="text" id="location-input" class="form-control form-control-lg">
            <br>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
        <hr>
        <div class="card-block mb-3" id="formatted-address"></div>
        <div class="card-block mb-3" id="address-components"></div>
        <div class="card-block mb-3" id="geometry"></div>
        <div id="map"></div>
    </div>
    <script defer async src="../controllers/geocode.js "></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly">
    </script>
</body>

</html>