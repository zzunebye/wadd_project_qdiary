<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <title>Q-diary</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="padding: 20px; background-color: #5580A0; color:#fff;">
        <div class="container-fluid d-flex justify-content-between align-items-center" >
                <a class="navbar-brand " style="color:#fff;">Q Journal</a>
                <ul class="navbar-nav d-flex justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.php" style="color:#fff;">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./journal.php" style="color:#fff;">My Journey</a>
                    </li>
                    
                </ul>
                <ul class="navbar-nav  d-flex justify-content-end">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"  style="color:#fff;" data-bs-toggle="dropdown" aria-expanded="false">
                            Setting
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            
                            <li stlye="display: flex; justify-content: center; align-item; center; width: 100%; height: 100%;">
                                <form id="form" class="form" action="./model/logout.php" method="POST">
                                    <button name="submit" type="submit" value="Login"
                                    style="outline: none; border: 0; margin-left: 20px; background-color: #fff;">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
        </div>
    </nav>
</body>

</html>