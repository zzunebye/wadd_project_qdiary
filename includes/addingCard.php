<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <script defer async src="map.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
        <div class="mb-3">
            <form id="mainContent" method="POST" action="./model/addCard.php" class="d-flex p-2 m-auto flex-column justify-content-center w-75 px-5 border border-primary rounded">
                <div>
                    <h2 class="text-center b5">Add Card for Today!</h2>
                </div>
                <div class="mb-3">
                    <input class="form-control" name="title" id="exampleFormControlTextarea1" placeholder="Write the title..." rows="1" required></input>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" name="thought" id="exampleFormControlTextarea1" placeholder="Write your thought..." rows="4" required></textarea>
                </div>
                <div class="d-flex mb-3 justify-content-between">
                    <label for="formFile" class="form-label  text-left">Add Image</label>
                    <input class="form-control col-9" name="picture" type="file" id="formFile">
                </div>
                <button class="btn btn-primary btn-sm" name="submit" type="submit" value="addJourney">Submit</button>
            </form>
            
        </div>

    </div>
    <script defer async src="./controllers/geocode.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOYJr7At-8assOQ-QddL2w5emwRH5LDFI&callback=initMap&libraries=&v=weekly">
    </script>


</body>

</html>