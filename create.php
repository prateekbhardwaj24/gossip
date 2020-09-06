<?php 
session_start();

require_once("connection.php");
include 'create.html';

if (isset($_POST['submit']))
{
    $name = htmlentities(mysqli_real_escape_string($con, $_POST['user_name']));
    
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['user_email']));
    
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
    
    $country  = htmlentities(mysqli_real_escape_string($con, $_POST['user_country']));
    
    $gender   = htmlentities(mysqli_real_escape_string($con, $_POST['user_gender']));
    
    $rand = rand(1, 2);
    
    

    if($name == ""){
        echo"<script>alert('we can not verify your name')</script>";
    }
    if(strlen($password)<8){
        echo"<script>alert('Password should be minimum 8 characters')</script>";
        exit();
    }
    
    $check_email = "select * from my_users1 where user_email='$email'";
    $run_email= mysqli_query($con, $check_email);
    $check = mysqli_num_rows($run_email);

    
    if($check==1){
        echo"<script>alert('Email already exist, please try again!')</script>";
        exit();
    }
    if($rand == 1)
        $profile_pic = "person1.png";
    else if($rand == 2)
        $profile_pic = "person2.png";
    
    $insert = "insert into my_users1 (user_name, user_email, user_pass, user_profile, user_country, user_gender) values('$name', '$email', '$password', '$profile_pic', '$country', '$gender')";
    
    
    $query = mysqli_query($con, $insert);
    
    if($query){
        
        $user = "select * from my_users1 where user_email='$email'";

        $run_user = mysqli_query($con, $user);
        
        $row_user= mysqli_fetch_array($run_user);
        
        $user_id = $row_user['user_id'];

        
        $insert1 = "insert into profile (user_email, user_id) values('$email', '$user_id')";
        $query1 = mysqli_query($con, $insert1);
        
         echo"<script>alert('congratulation $name , your account has been created successfully')</script>";
        echo"<script>window.open('login.php', '_self')</script>";
    }
    else {
        echo"<script>alert('Registration failed!, try again')</script>";
    }
    
    
   }
?>
