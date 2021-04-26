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

    <form class="w-75  m-auto justify-content-center border border-primary">
        <h2 class="text-center">
            Display Form Controls
        </h2>
        <div class="form-group">
            <label>City</label>
            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type the city that u are staying...">
            <datalist id="datalistOptions">
                <option value="San Francisco">
                <option value="New York">
                <option value="Seattle">
                <option value="Los Angeles">
                <option value="Hong Kong">
                <option value="Chicago">
            </datalist>
        </div>


        <div class="form-group mt-2">
            <label>Duration of quarantine</label>
            <select class="form-control">
                <option>2 Weeks</option>
                <option>3 Weeks</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="example-date-input" class="">Date</label>
            <div class="">
                <input class="form-control" type="date" value="" id="example-date-input">
            </div>
        </div>
        <div class="form-group mt-2">
            <label>Description</label>
            <textarea class="form-control"></textarea>
        </div>
    </form>
    <script defer async src="../controllers/geocode.js "></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly">
    </script>
</body>

</html>