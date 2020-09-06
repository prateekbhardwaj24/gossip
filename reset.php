<?php
session_start();
ob_start();
include "connection.php";

if(isset($_POST['send_mail'])){
    $mail = mysqli_real_escape_string($con,$_POST['in-email-mobile']);
    
    $select = "select * from my_users1 where user_email='$mail'";
    $query = mysqli_query($con,$select);
    
    $emailcount = mysqli_num_rows($query);
    
    if($emailcount){
        
        $userdata = mysqli_fetch_array($query);
        
        $username = $userdata['user_name'];
        $token = $userdata['token'];
        
 
        $subject  = "Password Reset";
        $body     = "Hi, $username click here to reset your password http://localhost/mychat/reset_password.php?token=$token ";
        $header   = "From: parasjhapr@gmail.com";


        if(mail($mail, $subject, $body, $header)){
            $_SESSION['msg'] = "check your mail to reset your password $mail";
            header("location: index.php");
            
            }
        else{
            echo "Email sending fail";
            }

        
        }
    else{
        echo "email not found";
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

    <!--    <div class="main">-->

    <div class="form_block">
        <div class="header">

            <div class="web_logo">
                <img src="logo.png">

            </div>
            <div class="web_name">
                <p align="center" class="login">Enter Valid E-mail</p>
            </div>
             

            <form action="" method="post">
                <div class="sign-in-form">
                    <div class="mobile-input">

                        <i class="fa fa-envelope text-muted " aria-hidden="true"></i>
                        <input type="text" name="in-email-mobile" id="email-mobile" class="input-text-field" placeholder='Email'>
                    </div>

                    <div class="login-button">
                        <input type="submit" value="Send mail" class="sign-in login" name="send_mail">
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!--    </div>-->


</body>

</html>
