<?php
    require_once('./dbconn.php');
    $firstname= $_POST['firstname']; 
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$firstname','$lastname','$email','$password'1v)";
    echo "1";
    $rs = mysqli_query($conn, $query)
        or die(mysqli_error($conn));
    
    
    // function NewUser() { 
    //     $firstname = $_POST['firstname']; 
    //     $lastname = $_POST['lastname']; 
    //     $password = $_POST['password']; 
    //     echo($firstname);
    //     echo($lastname);
    //     echo($password);
    //     $query = "INSERT INTO USERS (FirstName, LastName, Sex, DateOfBirth, Email, User_Password) VALUES ('$firstname','$lastname', '$sex', '$birth', '$email','$password')"; 
    //     $data = mysql_query ($query)or die(mysql_error());
    //     if($data) { 
    //         echo "YOUR REGISTRATION IS COMPLETED..."; 
    //         echo "<script>setTimeout(\"location.href = 'http://www2.comp.polyu.edu.hk/~17050864d//test/homePageVAV.php';\",2000);</script>";
    //     } 
    // }

    // if(isset($_POST['submit']))
    // {
    //     NewUser();
    // }
// NewUser();

?>
<script>
    
</script>