<?php
//session_start();
include 'connection.php';
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

    <style>
        body {
            overflow: hidden;
        }

    </style>

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
                <div class="modal-header">
                    <h2>Enter Password</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="table private">
                            <!--
                            <tr align="center">
                                <td colspan="6" class="active">
                                    <h2>Enter Password</h2>
                                </td>
                            </tr>
-->

                            <tr>
                                <td>Enter Set Password</td>
                                <td class="input">
                                    <input type="password" name="new_pass" class="form-control" id="mypass" required placeholder="Enter password">
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
                $pass = $_POST['new_pass'];
                
                $user = $_SESSION['user_email'];
                $sel = "select * from my_users1 where user_email='$user'";
                $run_user = mysqli_query($con, $sel);
                $row = mysqli_fetch_array($run_user);

                $user_pass = $row['private_pass'];
                
                if($pass != $user_pass){
                    echo"<script>alert('Wrong password try again!')</script>";
                }
                else{
                    echo"<script>window.open('demo.php', '_self')</script>";
                }
                    
            }
           ?>
                </div>
            </div>
        </div>
    </div>
    <!--    </div>-->
</body>

</html>
