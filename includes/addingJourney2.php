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
    <!-- <div id="mainContent" class="d-flex m-auto flex-column justify-content-center w-75 px-5 border border-primary"> -->

    <form method="POST" action="./model/addQurantine.php" class="w-75 p-2 d-flex flex-column m-auto px-5 justify-content-center border border-primary rounded">
        <h2 class="text-center">
            Add Journey
        </h2>
        <div class="d-flex m-auto w-100 justify-content-between">

            <div class="form-group w-50 mr-4">
                <label>Country</label>
                <input class="form-control" list="countryOptions" name="country" id="exampleDataList" placeholder="Type the country that u are staying...">
                <datalist id="countryOptions">
                    <option value="Germany">
                    <option value="Indonesia">
                    <option value="Japan">
                    <option value="China">
                    <option value="Hong Kong">
                    <option value="U.S.">
                </datalist>
            </div>
            <div class="form-group  w-50">
                <label>City</label>
                <input class="form-control" list="cityOptions" name="city" id="exampleDataList" placeholder="Type the city that u are staying...">
                <datalist id="cityOptions">
                    <option value="San Francisco">
                    <option value="New York">
                    <option value="Seattle">
                    <option value="Los Angeles">
                    <option value="Hong Kong">
                    <option value="Chicago">
                </datalist>
            </div>
        </div>


        <div class="form-group mt-2">
            <label>Duration of quarantine</label>
            <select class="form-control" name="duration">
                <option>2 Weeks</option>
                <option>3 Weeks</option>
            </select>
        </div>
        <div class="form-group mt-2">
            <label for="example-date-input" class="">Date</label>
            <div class="">
                <input class="form-control" type="date" name="startDate" value="" id="example-date-input">
            </div>
        </div>
        <div class="form-group mt-2">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>
        <button class="btn btn-primary btn-sm" name="submit" type="submit" value="addJourney">Submit</button>
        <!-- <a class="btn btn-primary btn-sm "name="submit" value="addJourney" type="submit" role="button">Upload</a> -->


    </form>
    <script defer async src="../controllers/geocode.js "></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly">
    </script>
</body>

</html>