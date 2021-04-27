<?php
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    require_once('./dbconn.php');
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])){
        $firstname= $_POST['firstname']; 
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user where email = '$email'";
        $rs=mysqli_query($conn,$sql)
			or die(mysqli_error($conn));
        if(mysqli_num_rows($rs) == 1){
            alert("Your email is already taken");
            
            header("Location:../signup/registerpage.php");
        }else{
            $query = "INSERT INTO user (first_name, last_name, email, user_password) VALUES ('$firstname','$lastname','$email','$password')";
            echo "1";
            $rs = mysqli_query($conn, $query)
                or die(mysqli_error($conn));
            session_start();
            $_SESSION["useremail"] = $email;
            $_SESSION["firstname"] = $firstname;
            $_SESSION["isLogin"] = 1;
            header("Location:../home.php");
        }
    }else{
        header("Location:../signup/registerpage.php");
    
    }
    
   
?>
<script>
    
</script>
