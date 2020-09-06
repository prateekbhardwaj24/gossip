<!DOCTYPE html>
<?php
  session_start();
include("connection.php");
//include "header1.php";
if(!isset($_SESSION['user_email'])){
    header('location:index.php');
}
else {
?>
<html lang="en">

<head>
<!--    <meta charset="UTF-8">-->
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="private.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

</head>
<body>
    <div class="row">
       <div class="col-sm-2">
       </div>      
       
       <div class="col-sm-8 mt-3">
           <form action="" method="post" enctype="multipart/form-data">
               <table class="table table-borderles table-condensed private">
                   <tr align="center">
                       <td colspan="6" class="active"><h2>Change Password</h2></td>
                   </tr>
                   <tr>
                       <td>Current Password</td>
                       <td class="input">
                           <input type="password" name="current_pass" class="form-control" id="mypass" required  placeholder="Current password">
                       </td>
                   </tr>
                   <tr>
                       <td>New Password</td>
                       <td class="input">
                           <input type="password" name="new_pass" class="form-control"  id="mypass" required  placeholder="New password">
                       </td>
                   </tr>
                   <tr>
                       <td>Confirm Password</td>
                       <td class="input">
                           <input type="password" name="confirm_pass" class="form-control" id="mypass" required  placeholder="Confirm password">
                       </td>
                   </tr>
                   <tr align="center">
                       <td colspan="6" class="submit">
                           <input type="submit" name="change" value="Change" class="btn btn-info">
                       </td>
                       
                   </tr>

               </table>
           </form>
           <?php
                if(isset($_POST['change'])){
                    $current_pass = $_POST['current_pass'];
                    $new_pass = $_POST['new_pass'];
                    $confirm_pass = $_POST['confirm_pass'];
                    
                    
                    $user = $_SESSION['user_email'];
                     $get_user = "select * from my_users1 where user_email='$user'";
                     $run_user = mysqli_query($con, $get_user);
                     $row = mysqli_fetch_array($run_user);

                     $user_pass = $row['user_pass'];
                    
                    if($current_pass != $user_pass){
                        echo"
                            <div class='alert alert-danger'>
                                <strong>Your Old password didn't match</strong>
                            </div>
                        ";
                    }
                    if($new_pass != $confirm_pass){
                        echo"
                            <div class='alert alert-danger'>
                                <strong>Your new password didn't match with confirm password</strong>
                            </div>
                        ";

                    }
    
                    if($new_pass == $confirm_pass AND $current_pass == $user_pass){
                        
                        $update_pass = mysqli_query($con, "UPDATE my_users1 SET user_pass='$new_pass' WHERE user_email='$user'"); 
                        echo"
                            <div class='alert alert-danger'>
                                <strong>Your password is changed</strong>
                            </div>
                        ";

                    }
                }
           ?>
           
       </div>
       <div class="col-sm-2">
           
       </div>
        
    </div>
</body>
</html>
<?php } ?>