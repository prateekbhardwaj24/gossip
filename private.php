<?php
session_start();
include 'connection.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>private</title>
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">




</head>

<body>
<!--
<form action="" method="post">
<button class="btn btn-primary" name="private">private</button>
   <a href="logout.php">logout</a>
    </form>
-->
    
    <?php
    if(isset($_POST['private'])){
        
        $user = $_SESSION['user_email'];
        $sel = "select * from my_users1 where user_email='$user'";
        $run_user = mysqli_query($con, $sel);
        $row = mysqli_fetch_array($run_user);
        
        $unique_id = $row['unique_id'];
        
        if($unique_id == ""){
//            echo"<script>window.open('demo3.php', '_self')</script>";
            echo "alert('hi')";
            
            
        }
        else{
//             echo"<script>window.open('demo4.php', '_self')</script>";
            
            echo '<div class="modal" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Modal body text goes here.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
            
            
        }
    }
    ?>
    
</body>

</html>
