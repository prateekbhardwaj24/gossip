<?php

session_start();
include 'PARASLOGIN.HTML';

require_once("connection.php");


if (isset($_POST['submit']))
{
    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));
    
    $email_search = " select * from my_users1 where user_email = '$email' AND user_pass='$password'";
    $query = mysqli_query($con,$email_search);
    
    $email_count = mysqli_num_rows($query);
    
    if($email_count == 1){
        $_SESSION['user_email']=$email;
        
        $update_msg = mysqli_query($con, "UPDATE my_users1 SET log_in='online' WHERE user_email='$email'");
        
        $user = $_SESSION['user_email'];
        $get_user = mysqli_query($con, $user);
        $row = mysqli_fetch_array($get_user);
        
        $user_name = $row['user_name'];
        
        echo"<script>window.open('demo.php?user_name=$user_name', '_self')</script>";
    }
    else {
        echo"
        <div class='alert alert-danger'>
            <strong>Chech ypur email and password</strong>
            </div>
            ";
    }
}
?>