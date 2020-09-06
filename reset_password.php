<?php
session_start();
ob_start();
include "connection.php";


if(isset($_POST['update'])){
    
    if(isset($_GET['token'])){
    $token = $_GET['token'];
    
    $pass = mysqli_real_escape_string($con, $_POST['in-pass']);
    $cpass = mysqli_real_escape_string($con, $_POST['cpass']);
    
    $hash_pass = password_hash($pass, PASSWORD_BCRYPT);
    
    if($pass === $cpass){
        
        $update = "update my_users1 set user_pass= '$hash_pass' where token='$token'";
        $query = mysqli_query($con, $update);
        
        if($query){
            $_SESSION['msg'] = "Your password has been update";
            header("location: index.php");
        }
        else{
            $_SESSION['passmsg'] = "your password is not updated";
            header("location: reset_password.php");
        }
        
    }
        else{
            $_SESSION['passmsg'] = "password is not matching";
//            echo "password are not matching";
        }
    
}
    else {
        echo "no token found";
    }
    
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>facebook</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
            body {
              background-image: url("heart-logo.png");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #f2f7fb;    
        }
    
    

    </style>
</head>

<body>

    <div class="form_block">

     
        <div class="header">
          
            <div class="web_logo">
                <img src="logo.png">
               
            </div>
            <div class="web_name">
                <p align="center" class="login">Update Password</p>
            </div>
             
             <p align="center" class="text-primary recover_msg"><?php
                  
                  if(isset($_SESSION['passmsg'])){
                      echo $_SESSION['passmsg'];
                  }
                  else{
                      echo $_SESSION['passmsg']= "";
                  }
                  ?>
              </p>
     
            <form action="" method="post">
                <div class="sign-in-form">
                    <div class="password-input">
                       
                        <i class="fa fa-key text-muted" aria-hidden="true"></i>
                        <input type="password" name="in-pass" id="in-password" class="input-text-field" placeholder="New Password">

                    </div>
                    <div class="password-input">
                       
                        <i class="fa fa-key text-muted" aria-hidden="true"></i>
                        <input type="password" name="cpass" id="in-password" class="input-text-field" placeholder="confirm Password">

                    </div>
                    <div class="login-button">
                        <input type="submit" value="Update" class="sign-in login" name="update">
                    </div>
                  
                </div>
            </form>
        </div>


    </div>

</body>

</html>
