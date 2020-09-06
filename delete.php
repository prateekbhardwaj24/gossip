<?php
include 'connection.php';
  session_start();
//include 'header1.php';

if(!isset($_SESSION['user_email'])){
    header('location:login.php');
}
?>


<?php
                     
 $user = $_SESSION['user_email'];
 $get_user = "select * from my_users1 where user_email = '$user'";
 $run_user = mysqli_query($con, $get_user);
 $row = mysqli_fetch_array($run_user);

 $user_id = $row['user_id'];
 $user_name = $row['user_name'];



if(isset($_GET['user_name'])){
     global $con;

     $get_username = $_GET['user_name'];
     $get_user = "select * from my_users1 where user_name = '$get_username'";

     $run_user = mysqli_query($con, $get_user);
     $row_user = mysqli_fetch_array($run_user);

     $username = $row_user['user_name'];
$sel_msg ="select * from user_chating1 where (sender='$user_name' AND receiver='$username') OR (receiver='$user_name' AND sender ='$username') ORDER by 1 ASC";
$run_msg = mysqli_query($con, $sel_msg);

     $row = mysqli_fetch_array($run_msg);

      $sender_username = $row['sender'];
    $receiver_username = $row['receiver'];
}
                     
                 ?>


<?php
if(isset($_POST['allchat'])){
                         
                              
$delete = "DELETE FROM user_chating1 WHERE (sender='$user_name' AND receiver='$username') OR (receiver='$user_name' AND sender ='$username') ORDER by 1 ASC";
$deletequery = mysqli_query($con, $delete);
    
    echo"<script>alert('data delete')</script>";
    
    
//    else{
//        echo"<script>alert('data not doesno't delete')</script>"
//    }
                    }

                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                               
?>
