<?php
session_start();
include "connection.php";
?>

<?php

    $user_id = $_SESSION['user_id'];
    $get_pass = "select * from my_users1 where user_id=$user_id";
    $pass_query = mysqli_query($con, $get_pass);
    $fetch_pass = mysqli_fetch_array($pass_query);
    
    $password_match = $fetch_pass['user_pass'];

    ?>



<?php
    if(isset($_POST['pass_match'])){
        
        $match_pass = mysqli_real_escape_string($con,$_POST['match_pass']);
        
//        $pass_hash = password_hash($match_pass, PASSWORD_BCRYPT);
        
        if(password_verify($match_pass, $password_match)){
            $userid = $_SESSION['user_id'];
            
            $delete_account = "delete from my_users1 where user_id=$userid";
            $query = mysqli_query($con, $delete_account);
                
        
        if($query){
            $delete_chat = "delete from user_chating1 where (sender=$userid OR receiver=$userid)";
            $query1 =  mysqli_query($con, $delete_chat);
            
            if($query1){
                $delete_reqst = "delete from friend_request where (sender=$userid OR receiver=$userid)";
                $query2 = mysqli_query($con, $delete_reqst);
                
                if($query2){
                    $delete_frnds = "delete from friends where (user_one=$userid OR user_two=$userid)";
                    $query3 = mysqli_query($con, $delete_frnds);
                    
                    if($query3){
                        $delete_post = "delete from post where userId=$userid";
                        $query4 = mysqli_query($con, $delete_post);
                        
                        if($query4){
                            $delete_react = "delete from react where reactBy=$userid";
                            $query5 = mysqli_query($con, $delete_react);
                            
                            if($query5){
                                $delete_profile = "delete from profile where userId=$userid";
                                $query6 = mysqli_query($con, $delete_profile);
                                
                                if($query6){
                                    $delete_comment = "delete from comments where commentBy=$userid";
                                    $query7 = mysqli_query($con, $delete_comment);
                                    
                                    if($query7){
                                        $delete_token = "delete from token where user_id=$userid";
                                        $query8 = mysqli_query($con, $delete_token);
                                        
                                        if($query8){
                                            echo "<script>alert('delete account')</script>";
                                            header("location: delete_page.php");
                                            
                                        }
                                        else{
                                            echo "<script>alert('doesn't delete account')</script>";
                                        }
                                    }
                                }
                            }
                        }
                     }
                }
            }
        }
            
        }
        else {
            $_SESSION['wrongpass'] = "Password is incorrect";
        }
    }
    
    
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="form_block">

        <div class="header">

            <div class="web_name">
                <p align="center" class="login">Enter Password</p>
            </div>

            <p align="center" class="text-primary recover_msg"><?php
                  
                  if(isset($_SESSION['wrongpass'])){
                      echo $_SESSION['wrongpass'];
                  }
                  else{
                      echo $_SESSION['wrongpass']= "";
                  }
                  ?>
            </p>


            <form action="" method="post">
                <div class="sign-in-form">

                    <div class="password-input">

                        <i class="fa fa-key text-muted" aria-hidden="true"></i>
                        <input type="password" name="match_pass" id="in-password" class="input-text-field" placeholder="Password">

                    </div>

                    <div class="login-button">
                        <input type="submit" value="Submit" class="sign-in login" name="pass_match">
                    </div>



                    <!--
        <input type="password" name="match_pass" placeholder="Enter Password">
        <input type="submit"  name="pass_match" value="update">
-->
                </div>
            </form>
        </div>
    </div>




</body>

</html>
