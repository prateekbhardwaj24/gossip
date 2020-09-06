<?php
//session_start();
include 'connection.php';
if(!isset($_SESSION['user_email'])){
    header('location:index.php');
}
else {
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Set Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
<!--    <link rel="stylesheet" href="private.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




</head>

<body>

    <!--

<div class="row">
       <div class="col-sm-2">
       </div>      
-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h2 class="modal-title">Set Password</h2>
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-borderles table-condensed private">
                        <!--
                        <tr align="center">
                            <td colspan="6" class="active">
                                <h2>Set Password</h2>
                            </td>
                        </tr>
-->

                        <tr>
                            <td>Set Password</td>
                            <td class="input">
                                <input type="password" name="new_pass" class="form-control" id="mypass" required placeholder="Set password">
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password</td>
                            <td class="input">
                                <input type="password" name="confirm_pass" class="form-control" id="mypass" required placeholder="Confirm password">
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
                  $set_pass = $_POST['new_pass'];
                  $confirm_pass = $_POST['confirm_pass'];
                  
                    $user = $_SESSION['user_email'];
                    $sel = "select * from my_users1 where user_email='$user'";
                    $run_user = mysqli_query($con, $sel);
                    $row = mysqli_fetch_array($run_user);
                    
                    $user_email = $row['user_email'];

                  
                  if($set_pass != $confirm_pass){
                      echo"<script>alert('Your set password and confirm password doesn't match!')</script>";
                  }
                  else{
                      $update = "update my_users1 set unique_id=UUID(), private_pass='$set_pass' where user_email='$user'";
                      $query = mysqli_query($con, $update);
                      
                      if($query){
                            echo"<script>alert('data insert')</script>";
                            echo"<script>window.open('demo4.php', '_self')</script>";
                      }
                      else{
                          echo"<script>alert('data not insert')</script>";
                      }
                  }
                  
                  
                  
              }
            ?>
                </div>
            </div>

        </div>
    </div>

    <!--
    <div class="col-sm-2"></div>
    </div>
-->
</body>

</html>
<?php } ?>
