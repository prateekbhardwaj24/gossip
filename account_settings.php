<!DOCTYPE html>
<?php
session_start();
include("connection.php");
//include("header1.php");
if(!isset($_SESSION['user_email'])){
    header('location:index.php');
}
else {
?>
<html lang="en">

<head>
<!--    <meta charset="UTF-8">-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Settings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="private.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/usm/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>


</head>

<body>
    
    

    <div style="font-size: 28px;">
        <a href="#" type="button" onclick="goBack()" class="ml-3" data-toggle="tooltip" title="Back"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
    </div>
<div class="container">

    <div class="row">
<!--        <div class="col-sm-2">-->
<!--        </div>-->
        <?php
         $user = $_SESSION['user_email'];
         $get_user = "select * from my_users1 where user_email='$user'";
         $run_user = mysqli_query($con, $get_user);
         $row2 = mysqli_fetch_array($run_user);
       
         $user_name = $row2['user_name'];
          $user_pass = $row2['user_pass'];
          $user_email = $row2['user_email'];
          $user_profile = $row2['user_profile'];
          $user_country = $row2['user_country'];
          $user_gender = $row2['user_gender'];
       ?>

        <div class="col-12 account_form mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-borderles table-condensed private">
                    <tr align="center">
                        <td colspan="6" class="active">
                            <h2>Change Account Settings</h2>
                        </td>
                    </tr>
                    <tr>
                        <td>Change Your username</td>
                        <td class="input">
                            <input type="text" name="u_name" class="form-control" required value="<?php echo $user_name;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Change Your Email</td>
                        <td class="input">
                            <input type="email" name="u_email" class="form-control" required value="<?php echo $user_email;?>">
                        </td>
                    </tr>





                    <tr>
                        <td></td>
                        <td class="input"><a href="change_password.php" class="btn btn-default"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a></td>
                    </tr>

                    <tr>
<!--                        <td></td>-->
                        <td class="input"><a href="delete_account.php" class="btn btn-danger"><i class="fa fa-trash mr-1"></i> Delete Account</a></td>
<!--                        <td></td>-->
                        <td class="input"><a href="blocklist.php" class="btn btn-primary"><i class="fa fa-ban"> Block List</i></a></td>
                    </tr>
                    
<!--
                    <tr>
                        <td></td>
                        <td class="input"><a href="blocklist.php" class="btn btn-primary">Block List</a></td>
                    </tr>
-->

                    <tr align="center">
                        <td colspan="6" class="submit">
                            <input type="submit" value="Update Profile" name="update" class="btn btn-info">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($_POST['update'])){
                    $user_name = htmlentities($_POST['u_name']);
                    $user_email = htmlentities($_POST['u_email']);
//                    $u_gender = htmlentities($_POST['u_gender']);
//                    $u_country = htmlentities($_POST['u_country']);
                    
                    
                    $update = "update my_users1 set user_name = '$user_name', user_email = '$user_email',userLink='$user_name' where user_email='$user' ";
                    
                    $run = mysqli_query($con, $update);
                    
                    if($run){
                        
                        $user_profile_id = $_SESSION['user_id'];
                         $update_profile = "update profile set user_name = '$user_name' where userId='$user_profile_id'";
                        $query_profile  = mysqli_query($con, $update_profile);
                        
                        if($query_profile){
                            
                            $update_post = "update post set user_name = '$user_name' where userId = '$user_profile_id'";
                            $query_post = mysqli_query($con, $update_post);
                        
                        
                         echo"
                           <script>alert('update successfully')</script>
                        ";
                        }
                       
                        echo "<script>window.open('account_settings.php', '_self')</script>";
                     
                    }
                    
                }
           ?>


            <?php
    
    
            
//             if(isset($_POST['delete_account'])){
//        
//                $user_id = $_SESSION['user_id'];
//                 
//                 $delete_account = "delete from my_users1 where user_id=$user_id";
//                 $query = mysqli_query($con, $delete_account);
//                 
////                  header("location: delete_account.php");
//        
//        if($query){
//            $delete_chat = "delete from user_chating1 where (sender=$user_id OR receiver=$user_id)";
//            $query1 =  mysqli_query($con, $delete_chat);
//            
//            if($query1){
//                $delete_reqst = "delete from friend_request where (sender=$user_id OR receiver=$user_id)";
//                $query2 = mysqli_query($con, $delete_reqst);
//                
//                if($query2){
//                    $delete_frnds = "delete from friends where (user_one=$user_id OR user_two=$user_id)";
//                    $query3 = mysqli_query($con, $delete_frnds);
//                    
//                    if($query3){
//                        $delete_post = "delete from post where userId=$user_id";
//                        $query4 = mysqli_query($con, $delete_post);
//                        
//                        if($query4){
//                            $delete_react = "delete from react where reactBy=$user_id";
//                            $query5 = mysqli_query($con, $delete_react);
//                            
//                            if($query5){
//                                $delete_profile = "delete from profile where userId=$user_id";
//                                $query6 = mysqli_query($con, $delete_profile);
//                                
//                                if($query6){
//                                    $delete_comment = "delete from comments where commentBy=$user_id";
//                                    $query7 = mysqli_query($con, $delete_comment);
//                                    
//                                    if($query7){
//                                        $delete_token = "delete from token where user_id=$user_id";
//                                        $query8 = mysqli_query($con, $delete_token);
//                                        
//                                        if($query8){
//                                            echo "<script>alert('delete account')</script>";
//                                            header("location: delete_page.php");
//                                            
//                                        }
//                                        else{
//                                            echo "<script>alert('doesn't delete account')</script>";
//                                        }
//                                    }
//                                }
//                            }
//                        }
//                     }
//                }
//            }
//        }
//    }
    
            
            
            ?>

        </div>
<!--        <div class="col-sm-2">-->
<!--        </div>-->

    </div>


    <div class="row">


<!--
        <div class="col-sm-2">
        </div>
-->
        <?php 
    include "connection.php";
    
    $user_id = $_SESSION['user_id'];    
    $select = "select * from profile where userId = $user_id ";
    $query = mysqli_query($con,$select);
    $row   = mysqli_fetch_array($query);
    
    $shortBio = $row['shortBio'];
    $currentCity = $row['currentCity'];
    $language  = $row['language'];
    $country  = $row['country'];
    $dob     = $row['dob'];
    $lifeEvent = $row['lifeEvent'];
    $professional = $row['professional'];
        
        
        
        ?>


        <div class="col-12 mt-3">

            <form action="" method="post" enctype="multipart/form-data">
                <table class="table table-borderles table-condensed private">
                    <tr align="center">
                        <td colspan="6" class="active">
                            <h2>About Yourself</h2>
                        </td>
                    </tr>

                    <tr>
                        <td>D O B</td>
                        <td class="input">

                            <input type="date" name="dob" class="form-control" value="<?php echo $dob;?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Bio</td>
                        <td class="input">
                            <textarea name="bio" id="" cols="5" rows="3" class="form-control" placeholder="<?php echo $shortBio ?>"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Home Town</td>
                        <td class="input">
                            <input type="text" name="city" class="form-control" value="<?php echo $currentCity ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td class="input">
                            <input type="text" name="country" class="form-control" value="<?php echo $country ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Language</td>
                        <td class="input">
                            <input type="text" name="Language" class="form-control" value="<?php echo $language ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Life Event</td>
                        <td class="input">
                            <input type="text" name="life" class="form-control" value="<?php echo $lifeEvent ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Profession</td>
                        <td class="input">
                            <input type="text" name="profession" class="form-control" value="<?php echo $professional ?>">
                        </td>
                    </tr>

                    <tr align="center">
                        <td colspan="6" class="submit">
                            <input type="submit" value="Update" name="submt" class="btn btn-info">
                        </td>
                    </tr>



                </table>

            </form>


            <?php
    
       $userid = $_SESSION['user_id'];
    
       if(isset($_POST['submt'])){
           $dob = $_POST['dob'];
           $bio = $_POST['bio'];
           $home = $_POST['city'];
           $language = $_POST['Language'];
           $life   = $_POST['life'];
           $country = $_POST['country'];
           $profession = $_POST['profession'];
           
            $userid = $_SESSION['user_id'];
           $insert = "update profile set shortBio= '$bio', currentCity= '$home', language= '$language', country= '$country', dob= '$dob', lifeEvent= '$life', professional= '$profession'  where userId= $userid ";
           
           $query = mysqli_query($con, $insert);
           
           if($query){
                echo"<script>alert('update successfully')</script>";
               echo "<script>window.open('account_settings.php', '_self')</script>";
           }
           else{
                echo"<script>alert('update not successfully')</script>";
                echo "<script>window.open('account_settings.php', '_self')</script>";
          
           }
       }
       
       
       ?>



        </div>

<!--        <div class="col-sm-2"></div>-->

    </div>
    </div>


    <script>
        function goBack() {
            window.history.back();
        }

    </script>


</body>

</html>
<?php } ?>
